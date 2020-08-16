#!/bin/bash

# Lists commits per month, over the repository's lifetime (tab-delimited)
# See https://gist.github.com/textarcana/c71939c74817d4110c012dc7c07d4a37

TZ=$(date +%z) git log --reverse --date-order --format="%cd" --date=iso-local \
    | cut -d- -f1-2 \
    | uniq -c \
    | column -t \
    | perl -pwe 's{\s+}{\t}'
