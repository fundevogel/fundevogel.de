<?php

use Pcbis\Webservice;
use GuzzleHttp\Client;
use GuzzleHttp\TransferStats;


function pcbis()
{
    # Initializing Webservice object
    $login = file_get_contents(kirby()->root('config') . '/knv.json');
    $login = json_decode($login, true);

    return new Webservice($login, kirby()->root('cache') . '/books');
}


function loadBook(string $isbn)
{
    try {
        $book = pcbis()->load($isbn);

        # Basic dataset
        $data = [
            'type'         => $book->type(),
            'isbn'         => $book->isbn(),
            'title'        => $book->title(),
            'subtitle'     => $book->subtitle(),
            'description'  => $book->description(),
            'price'        => $book->retailPrice(),
            'releaseYear'  => $book->releaseYear(),
            'age'          => $book->age(),
            'categories'   => $book->categories(),
            'topics'       => $book->topics(),
            'publisher'    => $book->publisher(),
            'isSeries'     => $book->isSeries(),
            'series'       => $book->series(),
            'volume'       => $book->volume(),
            'author'       => $book->author(),
            'illustrator'  => $book->illustrator(),
            'drawer'       => $book->drawer(),
            'photographer' => $book->photographer(),
            'translator'   => $book->translator(),
            'editor'       => $book->editor(),
            'participant'  => $book->participant(),
        ];

        # Extended dataset: book
        if ($book->isBook()) {
            $data = A::update($data, [
                'binding'   => $book->binding(),
                'pageCount' => $book->pageCount(),
                'antolin'   => $book->antolin(),
            ]);
        }

        # Extended dataset: audiobook
        if ($book->isAudiobook()) {
            $data = A::update($data, [
                'duration' => $book->duration(),
                'narrator' => $book->narrator(),
                'composer' => $book->composer(),
                'director' => $book->director(),
                'producer' => $book->producer(),
            ]);
        }

        # Extended dataset: ebook
        if ($book->isEbook()) {
            $data = A::update($data, [
                'devices'    => $book->devices(),
                'print'      => $book->print(),
                'fileSize'   => $book->fileSize(),
                'fileFormat' => $book->fileFormat(),
                'drm'        => $book->drm(),
            ]);
        }

        return $data;
    } catch (\Exception $e) {
        return [];
    }
}


function getShopLink($isbn): string
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

    (new Client())->get($url, [
        'on_stats' => function (TransferStats $stats) use (&$endpoint) {
            $endpoint = $stats->getEffectiveUri();
        }
    ]);

    if ($endpoint == $url) {
        # Doesn't exist, skipping ..
        return '';
    }

    return rtrim((string) $endpoint, '01234567890/%');
}
