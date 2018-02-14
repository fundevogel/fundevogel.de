<?php

/*
 * Production settings
 */

c::set('debug', false);
c::set('thumbs.driver', 'gd');
c::set('plugin.html.minifier.active', true);
c::set('plugin.kirby-sri', true);
c::set('cache', true);
