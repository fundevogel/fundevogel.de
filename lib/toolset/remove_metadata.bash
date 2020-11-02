#!/bin/bash

# Removes useless metadata creation for WebP images
# since there's no way to prevent this behavior in Kirby
# See https://github.com/getkirby/ideas/issues/192

find . -type f -name '*.webp.*.txt' -delete

find . -type f -name '*.avif.*.txt' -delete
