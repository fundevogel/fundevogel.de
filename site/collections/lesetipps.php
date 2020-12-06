<?php

return function ($site) {
    return $site->find('lesetipps')
                ->children()
                ->filterBy('intendedTemplate', 'lesetipps.article')
                ->listed()
                ->flip();
};
