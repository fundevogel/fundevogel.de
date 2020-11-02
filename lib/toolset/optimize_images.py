#!/usr/bin/python

import json
import subprocess
import sys

from pathlib import Path

from PIL import Image


def optimize_images(path: str):
    # Load list of already optimized images (if it exists)
    try:
        with open('storage/optimized_images.json', 'r') as file:
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
    for file in Path(path).rglob('*'):
        if file.name not in data and file.suffix.lower() in extensions:
            try:
                image = Image.open(file)
                file.unlink()

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
                with open('storage/optimized_images.json', 'w') as file:
                    json.dump(data, file)

            except Exception as error:
                print(error)


if __name__ == '__main__':
    if len(sys.argv) < 2:
        sys.exit('Usage: %s path/to/images' % sys.argv[0])

    optimize_images(sys.argv[1])
