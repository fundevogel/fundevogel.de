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
$pages = $kirby->page('buecher')->children()->listed();

# Store unavailable books
$block = [
    'ein-haufen-aerger',
];

# Loop through them
foreach ($pages as $page) {
    if (in_array($page->uid(), $block)) {
        continue;
    }

    echo $page->uid();

    try {
        # Authenticate as almighty & update book data
        $kirby->impersonate('kirby');
        $page->updateBook(true, ['shop']);

        sleep(5);
    } catch (\Exception $e) {
        echo ' .. failed! Moving on .. ' . "\n";
        continue;
    }

    echo ' .. done' . "\n";
}
