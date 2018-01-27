<?php

  return function($site, $pages, $page) {

    $posts = $page->children()
                  ->visible()
                  ->flip();
    $count = $posts->count();
    $last = $posts->last();

    if(r::ajax() && get('offset') && get('limit')) {
      $offset = intval(get('offset'));
      $limit  = intval(get('limit'));
      $posts  = $posts->offset($offset)->limit($limit);
      $more   = $count > $offset + 1;
    } else {
      $offset  = 0;
      $limit   = $page->limit()->int();
      $posts   = $posts->limit($limit);
    }

    return compact(
      'offset',
      'limit',
      'posts',
      'more',
      'last'
    );
};
