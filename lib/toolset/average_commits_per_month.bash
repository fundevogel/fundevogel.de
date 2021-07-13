#!/bin/bash

# Counts average number of commits for last X months in a Git repository
# See https://gist.github.com/mandiwise/dc53cb9da00856d7cdbb

months=$1

# If no argument passed ..
if [ -z "$1" ]; then
    # .. default to three months = quarter year
    months=3
fi

total=$(git log --since="$months months" --oneline | wc -l)

average=$((total / months))

echo "$average"
