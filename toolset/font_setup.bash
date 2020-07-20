#!/bin/bash

# Setting up & activating virtualenv
virtualenv -p python3 .env
# shellcheck disable=SC1091
source .env/bin/activate

# Installing dependencies
pip install -r requirements.txt

# Creating directory structure
for dir in toolset/dist \
           toolset/dependencies
do
    mkdir -p "$dir"
done

# Installing dependencies for `glyphhanger`
# See https://github.com/filamentgroup/glyphhanger

cd toolset/dependencies || exit

# Required for --flavor=woff2
git clone https://github.com/google/brotli
cd brotli && python setup.py install || exit

cd .. || exit  # Duh ..

# Required for --flavor=woff --with-zopfli
git clone https://github.com/anthrotype/py-zopfli
cd py-zopfli && git submodule update --init --recursive && python setup.py install || exit
