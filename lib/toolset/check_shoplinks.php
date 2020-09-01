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
  ]
]);

# Get pages, newest first
$pages = $kirby->page('lesetipps')->children()->flip();

# Loop through them
foreach ($pages->filterBy('intendedTemplate', 'lesetipps.article') as $page) {
    # Request shop link
    $response = Remote::get($page->shop(), ['timeout' => 0]);

    # Wait five seconds
    sleep(5);

    try {
        # Move on to next page if shop link is reachable
        if ($response->http_code() === 200) continue;
    } catch (\Exception $e) {
        echo $e->getMessage();
    }

    # Report pages with unreachable shop link
    echo $page->uid() . "\n";
}
