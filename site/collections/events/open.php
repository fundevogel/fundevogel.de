<?php

return function ($kirby) {
    # Current events without closed events equals open events
    return $kirby->collection('events/current')->without($kirby->collection('events/closed'));
};
