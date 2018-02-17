<?php

  return function($site, $pages, $page) {

    $all = $page->children()
                ->visible()
                ->flip();
    
    $posts = $all->paginate(($perpage >= 1) ? $perpage : 5);

    return [
      'posts' => $posts,
      'pagination' => $posts->pagination(),
      'last' => $all->last()
    ];
};
