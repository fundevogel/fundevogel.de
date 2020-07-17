<?php

# Generic functions
require_once 'functions.php';

# Kirby plugins
Kirby::plugin('fundevogel/methods', [
    'tags' => require_once 'tags.php',
    'fileMethods' => require_once 'file.php',
    'pageMethods' => require_once 'page.php',
    'pagesMethods' => require_once 'pages.php',
]);
