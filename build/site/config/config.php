<?php

include kirby()->roots()->config() . '/license.php';
include kirby()->roots()->config() . '/routes.php';
include kirby()->roots()->config() . '/languages.php';


// Development settings

c::set('debug', true);
c::set('fingerprint', false);
c::set('cache', false);
c::set('thumbs.driver', 'im');
c::set('plugin.compress', true);
