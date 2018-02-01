<?php


$kirby->set('blueprint',  'calendario', __DIR__ . DS . 'blueprints' . DS . 'calendario.yaml');
$kirby->set('blueprint',  'calendar-board-year', __DIR__ . DS . 'blueprints' . DS . 'calendar-board-year.yaml');
$kirby->set('blueprint',  'calendar-board-day', __DIR__ . DS . 'blueprints' . DS . 'calendar-board-day.yaml');
kirby()->set('field', 'calendarboard', __DIR__ . DS . 'fields' . DS . 'calendarboard');
