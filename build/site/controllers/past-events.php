<?php

return function($site, $pages, $page) {

  $image = $page->cover()->toFile();
  $thumb = thumb($image, array('width' => 460, 'quality' => 85));

  $count = 1;

  return compact(
    'image',
    'thumb',
    'events',
    'last',
    'count'
  );
};
