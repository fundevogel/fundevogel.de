import os
import json
import subprocess

from pathlib import Path

from doit import get_var
from PIL import Image
from requests import get
from yaml import safe_load


###
# CONFIG (START)
#

# CLI

DOIT_CONFIG = {
    'verbosity': 2,
    # 'action_string_formatting': 'old',
    'default_tasks': [
        'remove_metadata',
        'optimize_images',
    ],
}


# Directories

site_dir = 'site'
conf_dir = site_dir + '/config'
contents = 'content'
tool_dir = 'lib/toolset'

#
# CONFIG (END)
###


###
# TASKS (START)
#

# PYTHON tasks

def task_optimize_images():
    """
    Optimize images and create WebP & AVIF variants
    """
    def optimize_images():
        # Load list of already optimized images (if it exists)
        json_file = 'storage/optimized_images.json'

        try:
            with open(json_file, 'r') as file:
                data = json.load(file)

        except EnvironmentError:
            data = []

        # Extensions to look for
        extensions = [
            '.png',
            '.jpg',
            '.jpeg',
        ]

        # Get this party started
        for file in Path(get_var('path', contents)).rglob('*'):
            if file.name not in data and file.suffix.lower() in extensions:
                try:
                    # Load image data from file
                    image = Image.open(file)

                    # Create optimized version of original image
                    print('Processing {} ..'.format(file.name))

                    if file.suffix == '.png':
                        # If original image format is PNG:
                        # Make it as small as possible
                        image.save(file, format='PNG', optimize=True)

                    else:
                        # If original image mode is CMYK, 'keep'ing quality doesn't work
                        quality = 'keep' if image.mode == 'CMYK' == False else 100

                        # If original image format is JPEG:
                        # (1) Make it progressive
                        # (2) at maximum quality
                        # (3) but strip metadata
                        # (4) and set chroma subsampling mode to `420`
                        image.convert('RGB').save(file, format='JPEG', quality=quality, progressive=True, optimize=True, subsampling=2)

                    # Close file pointer
                    image.close()

                    # Create optimized WebP image
                    image = Image.open(file)
                    webp_file = file.with_suffix('.webp')

                    # Maximum compression (better, but slower)
                    print('Creating {} ..'.format(webp_file.name))
                    image.save(webp_file, format='WebP', method=6)

                    # Close file pointer
                    image.close()

                    # Create optimized AVIF image
                    # See https://github.com/kornelski/cavif-rs
                    avif_file = file.with_suffix('.avif')

                    # Overwrite if it already exists (must be enabled)
                    print('Creating {} ..'.format(avif_file.name))
                    subprocess.call(['cavif', str(file), '--overwrite', '--quiet'])

                    # Add image to list of optimized images ..
                    data.append(file.name)

                    # .. and save the updated list
                    with open(json_file, 'w') as file:
                        json.dump(data, file)

                except Exception as error:
                    print(error)

    return {
        'actions': [optimize_images],
    }


def task_rename_images():
    """
    Renames images after their folder
    """
    def rename_images():
        # Extensions to look for
        extensions = [
            '.png',
            '.jpg',
            '.jpeg',
        ]

        # Language extensions
        lang_extensions = [
            '.de.txt',
            '.en.txt',
            '.fr.txt',
        ]

        block_list = [
            '20200812_frisches-lesefutter-ajum-und-gew-lesetipps',
            '20201017_das-richtige-buch-zur-richtigen-zeit-finden',
            '20201026_auswertung-geno-umfrage',
        ]

        # Get this party started
        for path in Path(get_var('path', contents + '/1_aktuelles')).iterdir():
            dir_name = path.parts[-1]

            if dir_name in block_list:
                continue

            files = {file.resolve() for file in path.glob('*') if file.suffix.lower() in extensions}

            for count, file in enumerate(files):
                count += 1
                suffix = file.suffix
                with_suffix = file.name
                without_suffix = file.stem
                base_path = file.parent
                base_name = '-'.join(dir_name.split('_')[1:]) + '-' + str(count).zfill(2)

                # Rename regular image (if unprocessed)
                updated_file = base_path / (base_name + suffix)

                if updated_file.exists():
                    continue

                file.rename(updated_file)

                # Rename WebP image (if one exists)
                webp_file = base_path / (without_suffix + '.webp')

                if webp_file.exists():
                    updated_webp = base_path / (base_name + '.webp')
                    webp_file.rename(updated_webp)

                # Rename AVIF image (if one exists)
                avif_file = base_path / (without_suffix + '.avif')

                if avif_file.exists():
                    updated_avif = base_path / (base_name + '.avif')
                    avif_file.rename(updated_avif)

                # Rename metadata file(s)
                for lang_suffix in lang_extensions:
                    metadata = base_path / (with_suffix + lang_suffix)

                    if metadata.exists():
                        updated = base_path / (base_name + suffix + lang_suffix)
                        metadata.rename(updated)

    return {
        'actions': [rename_images],
    }


def task_fetch_colors():
    """
    Fetches language color codes from GitHub as JSON
    """
    def fetch_colors(targets):
        # Fetch `linugist` language data
        try:
            response = get('https://raw.githubusercontent.com/github/linguist/master/lib/linguist/languages.yml')

        except:
            return False

        if response.status_code != 200:
            return False

        # Define replacements for certain language names
        replacements = {
            'C++': 'CPP',
            'C#': 'C Sharp'
        }

        # Process colors from `linguist` language data
        # (1) Load their YAML representation
        data = safe_load(response.text)

        # (2) Organize colors in dictionary, replacing certain language names
        colors = dict((replacements.get(name, name), color['color']) for name, color in data.items() if 'color' in color)

        # (3) Sort colors (case-insensitive)
        colors = {key: colors[key] for key in sorted(colors, key=lambda string: string.lower())}

        # Store color data as JSON
        with open(targets[0], 'w') as file:
            json.dump(colors, file, indent=4)

    return {
        'actions': [fetch_colors],
        'targets': [conf_dir + '/colors.json'],
    }


# BASH tasks

def task_remove_metadata():
    """
    Removes metadata files for WebP & AVIF images
    """
    return {
        'actions': [
            'find . -type f -name "*.webp.*.txt" -delete',
            'find . -type f -name "*.avif.*.txt" -delete',
        ],
    }


def task_normalize_permissions():
    """
    Normalizes file permissions
    """
    return {
        'actions': ['bash %(targets)s'],
        'targets': [tool_dir + '/normalize_permissions.bash']
    }


# PHP tasks

def task_check_pages():
    """
    Checks all pages for errors
    """
    return {
        'actions': ['php %(targets)s'],
        'targets': [tool_dir + '/check_pages.php']
    }


def task_check_shoplinks():
    """
    Checks all shoplinks for errors
    """
    return {
        'actions': ['php %(targets)s'],
        'targets': [tool_dir + '/check_shoplinks.php']
    }


def task_update_ola():
    """
    Updates OLA records for all book pages
    """
    return {
        'actions': ['php %(targets)s'],
        'targets': [tool_dir + '/update_ola.php']
    }


def task_update_books():
    """
    Updates dataset of all book pages
    """
    return {
        'actions': ['php %(targets)s'],
        'targets': [tool_dir + '/update_books.php']
    }


def task_upgrade_books():
    """
    Upgrades dataset of all book pages
    """
    return {
        'actions': ['php %(targets)s'],
        'targets': [tool_dir + '/upgrade_books.php']
    }

#
# TASKS (END)
###


###
# UTILITIES (START)
#

def create_path(path):
    # Determine if (future) target is appropriate data file
    if os.path.splitext(path)[1].lower() == '.json':
        path = os.path.dirname(path)

    if not os.path.exists(path):
        try:
            os.makedirs(path)

        # Guard against race condition
        except OSError:
            pass


def load_json(json_file):
    try:
        with open(json_file, 'r') as file:
            return json.load(file)

    except json.decoder.JSONDecodeError:
        raise Exception

    return {}


def dump_json(data, json_file):
    create_path(json_file)

    with open(json_file, 'w') as file:
        json.dump(data, file, ensure_ascii=False, indent=4)

#
# UTILITIES (END)
###
