<?php

// Production settings

c::set('debug', false);
c::set('fingerprint', true);
c::set('cache', true);
c::set('cache.ignore', array('sitemap', 'shop'));
c::set('thumbs.driver', 'gd');
