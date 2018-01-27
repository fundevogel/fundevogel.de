<?php

return function($site, $pages, $page) {

  $lesetipps = $page->angaben()->toStructure();

  return [
    'count'     => 1,
    'lesetipps' => $lesetipps,
    'last'      => $lesetipps->last()
  ];
};
