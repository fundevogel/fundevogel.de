#!/usr/bin/python

import sys

from pathlib import Path

from PIL import Image


def png_to_jpg(path: str):
    # Get this party started
    for file in Path(path).rglob('*'):
        if file.suffix == '.png':
            try:
                # Create JPG version for PNG images
                print('Converting {} to {}..'.format(file.name, file.with_suffix('.jpg').name))

                # Load & destroy original image
                image = Image.open(file)
                file.unlink()

                # Save as JPG
                image.convert('RGB').save(file.with_suffix('.jpg'), format='JPEG', quality=100)

                # Close file pointer
                image.close()

            except Exception as error:
                print(error)


if __name__ == '__main__':
    if len(sys.argv) < 2:
        sys.exit('Usage: %s path/to/images' % sys.argv[0])

    png_to_jpg(sys.argv[1])
