#!/bin/bash

# Counts lines of code in all tracked files across current Git repository
#
# Note: This script covers only files recognized as 'programming languages'
# by `github-linguist`, so basically PHP, TypeScript, CSS, Python & Shell
#
# See https://gist.github.com/mandiwise/dc53cb9da00856d7cdbb

# Change to Git repository's top-level directory
cd "$(git rev-parse --show-toplevel)" || exit

# Gotta count 'em all' - except vendor plugins
count=$(git ls-files \
    Gulpfile.ts lib/gulp \
    public/index.php site/**/*.php \
    source/**/*.{css,js,ts} \
    lib/toolset/*.{bash,php,py} \
    | grep -Ev 'site/plugins' \
    | xargs wc -l \
    | tail -1 \
    | cut -d ' ' -f3
)

# Count version-controlled FV plugins separately
# (1) FV helper methods
fv=$(git ls-files site/plugins/fundevogel/**/*.php \
    | grep -Ev 'vendor' \
    | xargs wc -l \
    | tail -1 \
    | cut -d ' ' -f2
)

# (2) Kirby plugin for `pcbis.de` (unpublished)
pcbis=$(git ls-files site/plugins/kirby3-pcbis/**/*.php \
    | grep -Ev 'vendor' \
    | xargs wc -l \
    | tail -1 \
    | cut -d ' ' -f2
)

total=$((count + fv + pcbis))

echo "$total"
