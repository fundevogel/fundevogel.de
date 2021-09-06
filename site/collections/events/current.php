<?php

return function ($kirby) {
    $events = $kirby->collection('events/all');

    # Process events by ..
    return $events->not($kirby->collection('events/past'));
};
