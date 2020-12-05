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
        $book = $page->toBook(true);

        if (!$book->hasUpgrade()) {
            echo ' .. not needed! Moving on .. ' . "\n";
            sleep(2);

            continue;
        }

        # Authenticate as almighty & update book data
        $kirby->impersonate('kirby');
        $page->upgradeBook();

        sleep(5);
    } catch (\Exception $e) {
        echo ' .. failed! Moving on .. ' . "\n";
        continue;
    }

    echo ' .. done' . "\n";
}
