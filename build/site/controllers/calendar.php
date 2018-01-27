<?php

return function($site, $pages, $page) {

  $image = $page->cover()->toFile();
  $thumb = thumb($image, array('width' => 460, 'quality' => 85));

  $events = $page->events($own = true, $allies = array('children' => true, 'siblings' => true));
  $events = $events->sortBy('begin_date', 'asc');
  $events = $events->filter(function($child) { return $child->date(null, 'end_date') >= time(); });
  $last = $events->count();
  $count = 1;

  return compact(
    'image',
    'thumb',
    'events',
    'last',
    'count'
  );
};
