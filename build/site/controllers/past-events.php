<?php

return function($site, $pages, $page) {

  $image = $page->cover()->toFile();
  $thumb = thumb($image, array('width' => 460, 'quality' => 85));

  $years = page('kalender')->children()->flip();

  foreach($years as $year) {
    $days = $year->children()->flip();
    foreach($days as $day) {
      $dates = $day->events()->toStructure();
      $dates = $dates->filter(function($child) { return $child->date(null, 'end_date') < time(); });
      foreach($dates as $date) {
        $date = $date->append('day', $day->title());
        $events[] = $date;
      }
    }
  }

  $last = a::last($events);

  return compact(
    'image',
    'thumb',
    'events',
    'last'
  );
};
