<?php

return function($site, $pages, $page) {

  $images = $page->images();

  return compact(
    'images',
    'first'
  );
};
