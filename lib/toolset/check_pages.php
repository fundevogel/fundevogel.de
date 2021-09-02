<?php

include 'vendor/autoload.php';

# Initialize Kirby
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

# Loop through all pages
foreach ($kirby->site()->index() as $page) {
    try {
        # Render page
        $page->render();

    } catch (Exception $e) {
        # Report pages throwing errors
        echo 'Rendering ' . $page->id() . ' failed: ';
        echo $e->getMessage() . "\n";
    }
}
