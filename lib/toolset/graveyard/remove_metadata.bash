#!/bin/bash

# Removes useless metadata creation for WebP & AVIF images
# since there's no way to prevent this behavior in Kirby
# See https://github.com/getkirby/ideas/issues/192

# (1) WebP
find . -type f -name "*.webp.*.txt" -delete

# (2) AVIF
find . -type f -name "*.avif.*.txt" -delete
