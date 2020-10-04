#!/usr/bin/python

from pathlib import Path
import sys


def rename_images(path):
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
        '20201002_auswertung-geno-umfrage',
    ]

    # Get this party started
    for path in Path(path).iterdir():
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

            # Rename metadata file(s)
            for lang_suffix in lang_extensions:
                metadata = base_path / (with_suffix + lang_suffix)

                if metadata.exists():
                    updated = base_path / (base_name + suffix + lang_suffix)
                    metadata.rename(updated)


if __name__ == '__main__':
    if len(sys.argv) < 2:
        sys.exit('Usage: %s path/to/directories' % sys.argv[0])

    rename_images(sys.argv[1])
