<?php

use PHPCBIS\PHPCBIS;
use GuzzleHttp\Client;
use GuzzleHttp\TransferStats;

function pcbis()
{
    # Initializing PHPCBIS object
    $login = file_get_contents(kirby()->root('config') . '/knv.json');
    $login = json_decode($login, true);

    return new PHPCBIS($login);
}

function loadBook (string $isbn)
{
    $object = pcbis();
    $object->setCachePath(kirby()->root('cache') . '/books');

    $dataRaw = $object->loadBook($isbn);

    # If API call was unsuccessful ..
    if ($dataRaw == false) {
        return false;
    }

    return $object->processData($dataRaw);
}

function getShopLink ($isbn): string
{
    $baseUrl = 'https://fundevogel.buchkatalog.de/servlet/SearchDisplay?';
    $params = [
        'storeId=63715',
        'catalogId=10002',
        'langId=-3',
        'pageSize=10',
        'beginIndex=0',
        'sType=SimpleSearch',
        'resultCatEntryType=2',
        'showResultsPage=true',
        'pageView=',
        'pageType=PK',
        'searchTerm=' . $isbn,
        'searchBtn=',
        'mediaTypes=All%20Media',
    ];

    $url = $baseUrl . implode('&', $params);
    $endpoint = '';

    (new Client())->request('GET', $url, [
        'on_stats' => function (TransferStats $stats) use (&$endpoint) {
            $endpoint = $stats->getEffectiveUri();
        }
    ]);

    if ($endpoint == $url) {
        # Doesn't exist, skipping ..
        return '';
    }

    return (string) $endpoint;
}

function getLangVars ($language = 'de')
{
    $translations = Yaml::decode(F::read(
        kirby()->root('languages') . '/vars/' . $language . '.yml')
    );

    return $translations;
}

function useSVG ($title, $classes = '', $file = '', $customAttribute = '')
{
    if ($file === '') {
        $file = str_replace('-', '', $title);
        $file = strtolower($file);
    }

    return '<svg class="' . $classes . '" title="' . $title . '" role="img"' . r($customAttribute !== '', ' ' . $customAttribute) . '><use xlink:href="/assets/images/icons.svg#' . $file . '"></use></svg>';
}

function useSeparator ($color = 'orange-light', $position = 'top') {
    $margin = Str::contains($position, 'top') === true ? '-mb-px' : '-mt-px';

    return '<div class="w-full"><svg class="w-full h-auto ' . $margin . ' fill-current text-' . $color .'" role="img"><use xlink:href="/assets/images/icons.svg#' . $position . '"></use></svg></div>';
}
