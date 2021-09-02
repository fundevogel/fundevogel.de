#!/usr/bin/python

import sys

from pathlib import Path

from PIL import Image


def png2jpg(path: str):
    # Get this party started
    for file in Path(path).rglob('*'):
        if file.suffix == '.png':
            try:
                # Create JPG version for PNG images
                print('Converting {} to {}..'.format(file.name, file.with_suffix('.jpg').name))

                # Load original image
                image = Image.open(file)

                # Save as JPG
                image.convert('RGB').save(file.with_suffix('.jpg'), format='JPEG', quality=100)

                # Close file pointer
                image.close()

                # Delete original image
                file.unlink()

            except Exception as error:
                print(error)


if __name__ == '__main__':
    if len(sys.argv) < 2:
        sys.exit('Usage: %s path/to/images' % sys.argv[0])

    png2jpg(sys.argv[1])
