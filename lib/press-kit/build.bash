#!/bin/bash

# Trying system package
if command -v scribus &> /dev/null; then
    command="scribus"
fi

# Trying flatpak package
if command -v flatpak run net.scribus.Scribus &> /dev/null; then
    command="flatpak run net.scribus.Scribus"
fi

# Quit if neither is installed ..
if [ -z "$command" ]; then
  echo "Scribus isn't installed, exiting .."
  exit
fi

# .. otherwise, generate PDF
$command -g -py lib/press-kit/build.py \
    --input lib/press-kit/press-kit.sla \
    --output content/8_kontakt/presse-infos/dossier.pdf

# .. and create cover image
if command -v convert &> /dev/null; then
    convert \
        content/8_kontakt/presse-infos/dossier.pdf[0] \
        content/8_kontakt/presse-infos/dossier.pdf.jpg
fi
