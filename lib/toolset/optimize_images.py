#!/usr/bin/python

from pathlib import Path
import sys

from PIL import Image


def optimize_images(path: str, quality: int=85):
    # Extensions to look for
    extensions = [
        '.png',
        '.jpg',
        '.jpeg',
    ]

    # Get this party started
    for file in Path(path).rglob('*'):
        if file.suffix.lower() in extensions:
            try:
                # Create optimized JPEG image
                image = Image.open(file)
                file.unlink()

                if image.mode != 'RGB':
                    image = image.convert('RGB')

                jpg_file = file.with_suffix('.jpg')

                print('Processing {} ..'.format(file.name))
                image.save(jpg_file, format='JPEG', quality=quality, progressive=True, optimize=True, sampling=2)

                # Create optimized WebP image
                image = Image.open(jpg_file)
                webp_file = jpg_file.with_suffix('.webp')

                print('Creating {} ..'.format(webp_file.name))
                image.save(webp_file, format='WebP', method=6)

            except Exception as error:
                print(error)
                continue


if __name__ == '__main__':
    if len(sys.argv) < 2:
        sys.exit('Usage: %s path/to/images' % sys.argv[0])

    optimize_images(sys.argv[1])
