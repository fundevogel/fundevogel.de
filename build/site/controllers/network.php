<?php

return function($site, $pages, $page) {

  $partners = $page->netzwerk()->toStructure();

  return compact('partners');
};
