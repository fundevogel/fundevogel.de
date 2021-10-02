<?php

return function ($kirby) {
    # All events without past events equals current events
    return $kirby->collection('events/all')->without($kirby->collection('events/past'));
};
