<?php

return function($site, $pages, $page) {

  $image = $page->image();
  $thumb = thumb($image, array('width' => 460, 'quality' => 85));

  $bike = new Asset('assets/images/contact/bike.svg');
  $car = new Asset('assets/images/contact/car.svg');
  $tram = new Asset('assets/images/contact/tram.svg');

  return compact(
    'image',
    'thumb',
    'bike',
    'car',
    'tram'
  );
};
