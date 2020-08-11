#!/bin/bash

# Counts lines of code in all tracked files across our Git repository
# Note: This script covers only files recognized as 'programming languages'
# by `github-linguist`, so basically PHP, TypeScript, CSS, Python & Shell
# See https://gist.github.com/mandiwise/dc53cb9da00856d7cdbb

# Gotta count 'em all' - except vendor plugins
count=$(git ls-files \
    Gulpfile.ts lib/gulp \
    public/index.php site/**/*.php \
    source/**/*.{css,js,ts} \
    toolset/*.{bash,py} \
    | grep -Ev 'site/plugins|site/logs' \
    | xargs wc -l \
    | tail -1 \
    | cut -d ' ' -f3
)

# Count FV plugin separately
plugin=$(git ls-files site/plugins/fundevogel/*.php \
    | xargs wc -l \
    | tail -1 \
    | cut -d ' ' -f2
)

total=$((count + plugin))

echo "$total"
