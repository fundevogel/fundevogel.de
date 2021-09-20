<p>
    <?php
        # Event category
        $category = $event->category();

        e($category->isNotEmpty(), t('Was') . ': ' . $category->html() . '<br>');

        # Event start date & time
        $start_date = $event->date();
        $start_time = $event->begin_time();
        $start = strtotime($start_date . ' ' . $start_time);

        e($start, t('Wann') . ': ' . date('d.m.Y', $start) . '<br>');

        # Event end date & time
        $end_date = $event->end_date();
        $end_time = $event->end_time();
        $end = strtotime($end_date . ' ' . $end_time);

        if ($start_time->isNotEmpty()) {
            echo t('Zeit') . ': ' . date('H:i', $start);
            e($end_time && date('H:i', $end) !== date('H:i', $start), '- ' . date('H:i', $end));
            echo ' ' . t('Uhr') . '<br>';
        }

        # Event location
        $location = $event->location();

        e($location->isNotEmpty(), t('Ort') . ': ' . $location->html() . '<br>');
        e($end_date && date('d.m.Y', $end) !== date('d.m.Y', $start), t('Ende') . ': ' . date('d.m.Y', $end));

        # Event as calendar download
        $file = $event->uid() . '.ics';
    ?>
    <a
        class="mt-4 flex items-center"
        download="<?= $file ?>"
        href="<?= $page->url() . '/' . $file ?>"
    >
        <?= useSVG($event->title(), 'w-6 h-6 fill-current', 'calendar-filled') ?>
        <span class="ml-2">
            <?= t('iCal-Datei herunterladen') ?>
        </span>
    </a>
</p>
