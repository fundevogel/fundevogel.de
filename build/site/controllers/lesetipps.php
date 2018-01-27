<?php

return function($site, $pages, $page) {

  $perpage   = $page->perpage()->int();
  $lesetipps = $page->children()
                    ->visible()
                    ->flip()
                    ->paginate(($perpage >= 1)? $perpage : 5);

  return [
    'count'      => 1,
    'perpage'    => $perpage,
    'lesetipps'  => $lesetipps,
    'pagination' => $lesetipps->pagination()
  ];
};
