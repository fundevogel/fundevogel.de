#!/usr/bin/python

# Creates JSON with all language colors used on GitHub
# Based on
# - https://github.com/doda/github-language-colors
# - https://github.com/ozh/github-colors

import sys
import json
import yaml
import requests


def fetch_url(url):
    try:
        response = requests.get(url)
    except:
        sys.exit('Request fatal error :  %s' % sys.exc_info()[1])

    if response.status_code != 200:
        return False

    return response.text


if __name__ == '__main__':
    # Fetch `linugist` yaml data & load color data
    raw = fetch_url('https://raw.githubusercontent.com/github/linguist/master/lib/linguist/languages.yml')
    data = yaml.safe_load(raw)

    # Replace certain language names
    replacements = {
        'C++': 'CPP',
        'C#': 'C Sharp'
    }

    # Create color dictionary ..
    colors = dict((replacements.get(name, name), color['color']) for name, color in data.items() if 'color' in color)

    # .. and sort it, case-insensitive
    colors = {key: colors[key] for key in sorted(colors, key=lambda string: string.lower())}

    # Store color data as JSON
    with open(sys.argv[1] + '/colors.json', 'w') as file:
        json.dump(colors, file, indent=4)
