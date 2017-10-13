<?php

include kirby()->roots()->config() . '/license.php';
include kirby()->roots()->config() . '/routes.php';
include kirby()->roots()->config() . '/languages.php';


// Development settings

c::set('debug', true);
c::set('thumbs.driver', 'im');
