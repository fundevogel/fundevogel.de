<?php

return function($site, $pages, $page) {

  $images = $page->images();
  $first = $images->first();

  $options = array(
    'lazyLoad' => 'ondemand',
    'autoplay' => true,
    'arrows' => false,
    'fade' => true,
    'cssEase' => 'linear'
  );

  return compact('images', 'first', 'options');
};
