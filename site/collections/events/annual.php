<?php

return function ($site) {
    return $site->find('kalender')
                ->children()
                ->filterBy('intendedTemplate', 'calendar.single')
                ->listed();
};
