<?php

return function ($page) {
    $allTopics = page('buecher')
        ->children()
        ->pluck('topics', ',')
    ;

    $countedTopics = array_count_values($allTopics);
    ksort($countedTopics);

    $topics = [];

    foreach ($countedTopics as $topic => $count) {
        $firstCharacter = Str::substr($topic, 0, 1);
        $topics[$firstCharacter][] = [$topic, $count];
    }

    return compact(
        'topics',
    );
};
