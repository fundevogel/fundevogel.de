<?php

return function ($kirby, $page) {
    # Process topics
    # (1) Collect topic(s) for every reviewed book
    $allTopics = $kirby->collection('books/reviewed')->pluck('topics', ',');

    # (2) Sort them by first letter
    $order = [
        'A',
        'Ä',
        'B',
        'C',
        'D',
        'E',
        'F',
        'G',
        'H',
        'I',
        'J',
        'K',
        'L',
        'M',
        'N',
        'O',
        'Ö',
        'P',
        'Q',
        'R',
        'S',
        'T',
        'U',
        'Ü',
        'V',
        'W',
        'X',
        'Y',
        'Z',
    ];

    usort($allTopics, function ($a, $b) use ($order) {
        $a = Str::upper(Str::substr($a, 0, 1));
        $b = Str::upper(Str::substr($b, 0, 1));

        return array_search($a, $order) - array_search($b, $order);
    });

    # (3) Count them
    $countedTopics = array_count_values($allTopics);

    # (4) Group by first character
    $topics = [];

    foreach ($countedTopics as $topic => $count) {
        $firstCharacter = Str::upper(Str::substr($topic, 0, 1));
        $topics[$firstCharacter][] = [$topic, $count];
    }

    $layouts = $page->layouts()->toLayouts();

    return compact('layouts', 'topics');
};
