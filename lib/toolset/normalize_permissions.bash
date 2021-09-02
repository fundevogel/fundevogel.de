#!/bin/bash

# Normalizes file permissions

# Loop over relevant directories
for dir in content \
           public \
           site/blueprints \
           site/config \
           site/controllers \
           site/languages \
           site/models \
           site/plugins/fundevogel \
           site/snippets \
           site/templates \
           source
do
    # (1) Directories
    find "$dir" -type d -exec chmod 0755 {} \;

    # (2) Files
    find "$dir" -type f -exec chmod 0644 {} \;
done
