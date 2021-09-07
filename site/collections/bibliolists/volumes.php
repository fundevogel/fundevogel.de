<?php

return function ($site) {
    return $site->find('lesetipps/neuerscheinungen')
                ->children()
                ->filterBy('intendedTemplate', 'lesetipps.volume');
};
