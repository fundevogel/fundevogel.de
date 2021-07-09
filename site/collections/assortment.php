<?php

return function ($site) {
    return $site->find('unser-sortiment')
                ->children()
                ->listed()
                ->onlyTranslated();
};
