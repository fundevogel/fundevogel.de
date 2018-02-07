<?php

return function($site, $pages, $page) {

  $lesetipps = $page->angaben()->toStructure();
  $last = $lesetipps->last();

  return compact(
    'lesetipps',
    'last'
  );
};
