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

function loadBook (string $isbn, bool $exportOnly = true)
{
    $object = pcbis();
    $object->setCachePath(kirby()->root('cache') . '/books');

    try {
        $book = $object->load($isbn);

        if ($exportOnly) {
            return [
                'title'         => $book->title(),
                'book_title'    => $book->title(),
                'book_subtitle' => $book->subtitle(),
                'isbn'          => $book->isbn(),
                'description'   => $book->description(),
                'author'        => $book->author(),
                'illustrator'   => $book->illustrator(),
                'translator'    => $book->translator(),
                'publisher'     => $book->publisher(),
                'age'           => $book->age(),
                'page_count'    => $book->pageCount(),
                'price'         => $book->retailPrice(),
                'binding'       => $book->binding(),
                'categories'    => $book->categories(),
                'topics'        => $book->topics(),
                'isAudiobook'   => $book->isAudiobook(),
                'shop'          => rtrim(getShopLink($isbn), '01234567890/'),
            ];
        }
    } catch (\Exception $e) {
        return [];
    }

    return $book;
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

    $svgPath = 'assets/images/icons/' . $file . '.svg';
    $svg = (new Asset($svgPath))->read();

    return Str::replace($svg, '<svg', '<svg class="' . $classes . '" title="' . $title . '" role="img"' . r($customAttribute !== '', ' ' . $customAttribute), 1);
}

function useSeparator ($color = 'orange-light', $position = 'top') {
    $svgPath = 'assets/images/icons/' . $position . '.svg';
    $svg = (new Asset($svgPath))->read();

    $margin = Str::contains($position, 'top') === true ? '-mb-px' : '-mt-px';

    return '<div class="w-full">' . Str::replace($svg, '<svg', '<svg class="w-full h-auto ' . $margin . ' fill-current text-' . $color .'" role="img"', 1) . '</div>';
}
