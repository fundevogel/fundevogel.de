<?php

c::set('license', 'my_license_key');

include kirby()->roots()->config() . '/routes.php';
include kirby()->roots()->config() . '/languages.php';
include kirby()->roots()->config() . '/thumbs.php';
// include kirby()->roots()->config() . '/panel.php';

// Development settings
c::set('debug', true);
c::set('fingerprint', false);
c::set('cache', false);
