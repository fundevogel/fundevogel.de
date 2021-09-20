<p>
    <?php
        $category = $event->category();
        $start_date = $event->date();
        $start_time = $event->begin_time();
        $end_date = $event->end_date();
        $end_time = $event->end_time();
        $start = strtotime($start_date . ' ' . $start_time);
        $end = strtotime($end_date . ' ' . $end_time);
        $location = $event->location();

        e($category->isNotEmpty(), t('Was') . ': ' . $category->html() . '<br>');
        e($start, t('Wann') . ': ' . date('d.m.Y', $start) . '<br>');

        if ($start_time->isNotEmpty()) {
            echo t('Zeit') . ': ' . date('H:i', $start);
            e($end_time && date('H:i', $end) !== date('H:i', $start), '- ' . date('H:i', $end));
            echo ' ' . t('Uhr') . '<br>';
        }

        e($location->isNotEmpty(), t('Ort') . ': ' . $location->html() . '<br>');
        e($end_date && date('d.m.Y', $end) !== date('d.m.Y', $start), t('Ende') . ': ' . date('d.m.Y', $end));
    ?>
</p>
