<div class="card is-dashed text-center">
    <h4 class="text-base"><?= t('Termin im Überblick') ?></h4>
    <p class="content text-sm">
        <?php
            # Print date(s)
            # (1) Start date
            $start = $event->date();

            echo $start->toDate('d.m.Y');

            # (2) End date (if specified)
            $end = $event->dateEnd();

            if ($end->toDate('Ymd') <= $start->toDate('Ymd')) {
                $end->toDate('d.m.Y');
            }

            # Print time(s)
            if ($start->toDate('H:i') != '00:00') {
                # Start
                echo ', ' . $start->toDate('H:i');

                # End (if specified)
                e($end->toDate('H:i') != '00:00', ' - ' . $end->toDate('H:i'));

                echo ' ' . t('Uhr');
            }

            echo '<br>';

            # Print location
            $location = $event->location();
            e($location->isNotEmpty(), $location->html() . '<br>');

            # Print recommended age
            $audience = $event->audience();
            e($audience->isNotEmpty(), $event->audience()->html() . '<br>');

            # Print admission fee ..
            if ($event->costsAdmission()->bool()) {
                e($event->admissionChildren()->isNotEmpty(), t('Kinder') . ' ' . $event->admissionChildren() . ' €');
                e($event->admissionChildren()->isNotEmpty() && $event->admissionAdults()->isNotEmpty(), ' &middot ');
                e($event->admissionAdults()->isNotEmpty(), t('Erwachsene') . ' ' . $event->admissionAdults() . ' €');
            }

            # .. if any
            else {
                echo t('Eintritt frei') . '!';
            }

            # Provide download for event
            $iCal = $event->file('calendar.ics');
        ?>
        <a
            class="mt-4 flex justify-center items-center"
            download="<?= $iCal->filename() ?>"
            href="<?= $iCal->url() ?>"
        >
            <?= useSVG($event->title(), 'w-6 h-6 fill-current', 'calendar-filled') ?>
            <span class="ml-2">
                <?= t('iCal-Datei herunterladen') ?>
            </span>
        </a>
    </p>
</div>
