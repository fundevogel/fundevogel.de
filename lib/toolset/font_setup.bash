#!/bin/bash

# Setting up & activating virtualenv
virtualenv -p python3 .env

# shellcheck disable=SC1091
source .env/bin/activate

# Installing dependencies
pip install -r requirements.txt

# Creating directory structure
mkdir -p toolset/dependencies

# Installing dependencies for `glyphhanger`
# See https://github.com/zachleat/glyphhanger

cd toolset/dependencies || exit

# Brotli
# Required for --flavor=woff2
# (1) Clone repository
git clone https://github.com/google/brotli

# (2) Install library
cd brotli || exit
python setup.py install

# (3) Remove entire `brotli` directory
cd .. || exit
rm -rf brotli

# Zopfli
# Required for --flavor=woff --with-zopfli
# (1) Clone repository
git clone https://github.com/anthrotype/py-zopfli

# (2) Install library
cd py-zopfli || exit
git submodule update --init --recursive && python setup.py install

# (3) Remove entire `py-zopfli` directory
cd .. || exit
rm -rf py-zopfli
