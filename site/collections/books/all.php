<?php

return function ($site) {
    return $site->find('buecher')->children()->listed();
};
