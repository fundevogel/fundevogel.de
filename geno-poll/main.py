#!/usr/bin/python3

import os

from collections import Counter

from matplotlib import pyplot as plotter
from pandas import DataFrame


# See https://stackoverflow.com/a/42049019
def between(string, start, end):
    return string[string.find(start) + len(start):string.rfind(end)].strip()


def dump_csv(data, csv_file):
    DataFrame(data).to_csv(csv_file, index=False)

    return True


if __name__ == "__main__":
    # Load raw data
    with open('../site/geno-umfrage--mitarbeiter.log', 'r') as file:
        raw = file.read()

    ## I. CSV REPORT
    #
    # Set start & end for each datapoint
    sections = [
        ('Name:', 'Adresse:'),
        ('Adresse:', 'KundeSeit:'),
        ('KundeSeit:', 'InteresseKJL:'),
        ('InteresseKJL:', 'BesonderheitenFV:'),
        ('BesonderheitenFV:', 'AngebotErweitern:'),
        ('AngebotErweitern:', 'AngebotErweiternWie:'),
        ('AngebotErweiternWie:', 'SortimentBeratungZufrieden:'),
        ('SortimentBeratungZufrieden:', 'SortimentBeratungWas:'),
        ('SortimentBeratungWas:', 'ServiceSchnelligkeitZufrieden:'),
        ('ServiceSchnelligkeitZufrieden:', 'ServiceSchnelligkeitWas:'),
        ('ServiceSchnelligkeitWas:', 'OeffnungszeitenWerktag:'),
        ('OeffnungszeitenWerktag:', 'OeffnungszeitenSamstag:'),
        ('OeffnungszeitenSamstag:', 'BeitrittGenoVorstellbar:'),
        ('BeitrittGenoVorstellbar:', 'HoeheAnteile:'),
        ('HoeheAnteile:', 'HoeheAnteileAlternativ:'),
        ('HoeheAnteileAlternativ:', 'MithilfeVorstellbar:'),
        ('MithilfeVorstellbar:', 'MithilfeWas:'),
    ]

    data = []

    # Create list of dictionaries holding data
    for content in raw.split('[2020-'):
        node = {}

        for section in sections:
            (current, next) = section
            node[current[:-1]] = between(content, current, next)

        data.append(node)

    # .. or if you're a crazy person:
    # data = [{current[:-1]:between(content, current, next) for (current, next) in [section for section in sections]} for content in raw.split('[2020-')]

    results = []

    for item in data:
        # Remove dicts containing only empty strings
        # See https://stackoverflow.com/a/35254031
        if all(value == '' for value in item.values()):
            continue

        results.append(item)

    # Create directory (if it doesn't exist)
    if not os.path.exists('dist'):
        os.makedirs('dist')

    # Print CSV file with results
    dump_csv(results, os.path.join('dist', 'report_ ' + str(len(results)) + '.csv'))


    ## II. PIE CHARTS
    #
    # Plot pie charts for given categories
    categories = [
        'InteresseKJL',
        'AngebotErweitern',
        'SortimentBeratungZufrieden',
        'ServiceSchnelligkeitZufrieden',
        'MithilfeVorstellbar',
        'BeitrittGenoVorstellbar',
        'HoeheAnteile',
        'HoeheAnteileAlternativ',
    ]

    for category in categories:
        counter = Counter()

        for result in results:
            counter[result[category]] += 1

        figureObject, axesObject = plotter.subplots()
        axesObject.pie(counter.values(), labels=counter.keys(), autopct='%1.2f', startangle=90)
        axesObject.axis('equal')

        plotter.savefig(os.path.join('dist', category + '.png'))
