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

# Loop through all pages
foreach ($kirby->site()->index() as $page) {
    try {
        # Render page
        echo 'Rendering ' . $page->id() . ' ..';
        $page->render();

        # Report either `render()` being successful ..
        echo " done!\n";
    } catch (\Exception $e) {
        # .. or output error message upon failure
        echo " failed!\n";
        echo $e->getMessage();
    }
}
