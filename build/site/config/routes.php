<?php

// Routes

c::set('routes', array(
  array(
    'pattern' => 'home/(:any)',
    'action'  => function() {
       go('/');
    }
  )
));
