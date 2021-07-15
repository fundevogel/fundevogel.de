<?php

include '../vendor/autoload.php';

$kirby = new Kirby([
  'roots' => [
    'index'    => __DIR__,
    'base'     => $base    = dirname(__DIR__),
    'site'     => $base . '/site',
    'content'  => $base . '/content',
    'storage'  => $storage = $base . '/storage',
    'accounts' => $storage . '/accounts',
    'cache'    => $storage . '/cache',
    'logs'     => $storage . '/logs',
    'sessions' => $storage . '/sessions',
  ]
]);

echo $kirby->render();
