#!/bin/bash

# Removes useless lossless WebP images
# since we want only lossy files

find . -type f -name '*.lossless.webp' -delete
