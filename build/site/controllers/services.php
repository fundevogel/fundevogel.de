<?php

return function($site, $pages, $page) {

  $services = $page->services()->toStructure();

  return compact('services');
};
