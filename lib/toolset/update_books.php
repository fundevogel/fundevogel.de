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

        # Update book page
        $page->updateBook(true, ['shop']);

        echo 'Successfully updated ' . $page->uid() . "\n";

        # Wait three seconds
        sleep(3);

    } catch (Exception $e) {}
}
