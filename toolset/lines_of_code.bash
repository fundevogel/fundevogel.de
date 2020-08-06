#!/bin/bash

# Counts lines of code in all tracked files in a Git repository
# See https://gist.github.com/mandiwise/dc53cb9da00856d7cdbb

# Gotta count 'em all'
count=$(git ls-files \
    Gulpfile.ts tsconfig.json Vagrantfile \
    lib/gulp public/index.php site \
    source/scripts source/styles \
    toolset/*.{bash,py} \
    | grep -Ev 'site/blueprints|site/plugins|site/logs|.tmp|.log|.bak|.lock' \
    | xargs wc -l \
    | tail -1 \
    | cut -d ' ' -f3
)

# Count excluded FV plugin separately
plugin=$(git ls-files \
    site/plugins/fundevogel \
    | xargs wc -l \
    | tail -1 \
    | cut -d ' ' -f2
)

total=$((count + plugin))

echo "$total"
