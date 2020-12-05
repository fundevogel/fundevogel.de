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

# Loop through them
foreach ($pages as $page) {
    try {
        # Request shop link
        $response = Remote::get($page->shop(), ['timeout' => 0]);

        # Wait five seconds
        sleep(5);

        # Move on to next page if shop link is reachable
        if ($response->http_code() === 200) continue;
    } catch (Exception $e) {
        echo $e->getMessage();
    }

    # Authenticate as almighty & update shop link
    $kirby->impersonate('kirby');

    if ($page->update(['shop' => getShopLink($page->isbn()->value())])) {
        continue;
    }

    # Report pages with unreachable shop link
    echo $page->uid() . "\n";
}
