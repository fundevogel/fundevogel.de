<?php

return function($site, $pages, $page) {

  $perpage   = $page->perpage()->int();
  $lesetipps = $page->children()
                    ->visible()
                    ->flip()
                    ->paginate(($perpage >= 1)? $perpage : 5);
  $pagination = $lesetipps->pagination();

  return compact(
    'perpage',
    'lesetipps',
    'pagination'
  );
};
