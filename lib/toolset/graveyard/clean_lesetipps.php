<?php

include 'vendor/autoload.php';

# Init Kirby
$kirby = new Kirby([
    'roots' => [
        'base'     => $base = '.',
        'index'    => $base . '/public',
        'site'     => $base . '/site',
        'content'  => $base . '/content',
        'storage'  => $storage = $base . '/storage',
        'accounts' => $storage . '/accounts',
        'cache'    => $storage . '/cache',
        'sessions' => $storage . '/sessions',
    ],
]);

# Get `book` pages
$pages = $kirby->page('lesetipps')->children()->listed();

# Loop through them
foreach ($pages as $page) {
    echo $page->uid();

    try {
        # Authenticate as almighty & update book data
        $kirby->impersonate('kirby');
        $page->update([
            'book_title'    => null,
            'book_subtitle' => null,
            'cover'         => null,
            'hasAward'      => null,
            'awardEdition'  => null,
            'leseLink'      => null,
            'isbn'          => null,
            'shop'          => null,
            'author'        => null,
            'illustrator'   => null,
            'narrator'      => null,
            'translator'    => null,
            'participants'  => null,
            'page_count'    => null,
            'duration'      => null,
            'publisher'     => null,
            'age'           => null,
            'award'         => null,
            'price'         => null,
            'binding'       => null,
            'categories'    => null,
            'topics'        => null,
            'isAudiobook'   => null,
        ]);
    } catch (\Exception $e) {
        // echo ' .. failed! Moving on .. ' . "\n";
        echo $e->getMessage();
        continue;
    }

    echo ' .. done' . "\n";
}
