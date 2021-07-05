<?php

return function ($site) {
    return $site->find('news')
                ->children()
                ->filterBy('intendedTemplate', 'news.article')
                ->listed()
                ->flip();
};
