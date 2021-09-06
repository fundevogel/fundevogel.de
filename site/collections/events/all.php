<?php

return function ($site) {
    return $site->find('kalender/veranstaltungen')
                ->children()
                ->listed();
};
