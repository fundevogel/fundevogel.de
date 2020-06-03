<p>
    <?php
        $category = $event->category();
        $start_time = $event->begin_time();
        $end_time = $event->end_time();
        $start_date = $event->date();
        $end_date = $event->end_date();
        $start = strtotime($start_date . ' ' . $start_time);
        $end = strtotime($event->end_date() . ' ' . $event->end_time());
        $location = $event->location();

        e($category->isNotEmpty(), t('kalender_termin-thema') . ': ' . $category->html() . '<br>');
        e($start, t('kalender_termin-tage') . ': ' . date('d.m.Y', $start) . '<br>');

        if($start_time->isNotEmpty()) {
            echo t('kalender_termin-zeit') . ': ' . date('H:i', $start);
            e($end_time && date('H:i', $end) !== date('H:i', $start), '- '. date('H:i', $end));
            echo ' ' . t('kalender_termin-uhr') . '<br>';
        }

        e($location->isNotEmpty(), t('kalender_termin-ort') . ': ' . $location->html() . '<br>');
        e($end_date && date('d.m.Y', $end) !== date('d.m.Y', $start), t('kalender_termin-ende') . ': ' . date('d.m.Y', $end));
    ?>
</p>
