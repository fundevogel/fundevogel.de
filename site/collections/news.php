<?php

return function ($site) {
    return $site->find('aktuelles')
                ->children()
                ->filterBy('intendedTemplate', 'news.article')
                ->listed()
                ->flip();
};
