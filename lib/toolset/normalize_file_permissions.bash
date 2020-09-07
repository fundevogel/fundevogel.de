#!/bin/bash

# Normalizes file permissions

# Loop over relevant directories
for dir in content \
           public \
           site \
           source
do
    # Directories
    find "$dir" -type d -exec chmod 0755 {} \;

    # Files
    find "$dir" -type f -exec chmod 0644 {} \;
done
