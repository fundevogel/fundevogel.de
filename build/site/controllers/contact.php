<?php

return function($site, $pages, $page) {

  $image = $page->image();
  $thumb = thumb($image, array('width' => 460, 'quality' => 85));

  return compact('image', 'thumb');
};
