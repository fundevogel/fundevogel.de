<div class="card is-dashed text-center">
    <h4 class="text-base"><?= t('Termin im Überblick') ?></h4>
    <p class="content text-sm">
        <?php
            # Event start date & time
            $dateStart = $event->date();
            $timeStart = $event->timeStart();
            $start = strtotime($dateStart . ' ' . $timeStart);

            # Event end date & time
            $dateEnd = $event->dateEnd();
            $timeEnd = $event->timeEnd();
            $end = strtotime($dateEnd . ' ' . $timeEnd);

            # Print date(s)
            # (1) Start date
            e($start, date('d.m.Y', $start));

            # (2) End date (if specified)
            if ($event->multipleDays()->bool()) {
                e(date('Ymd', $end) > date('Ymd', $start), ' - ' . date('d.m.Y', $end));
            }

            # Print time(s)
            if ($event->showTime()->bool()) {
                # Start
                if ($timeStart->isNotEmpty()) {
                    echo ', ' . date('H:i', $start);

                    # End (if specified)
                    e($timeEnd && date('H:i', $end) !== date('H:i', $start), ' - ' . date('H:i', $end));
                }

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
            $iCal = $event->iCal();
        ?>
        <a
            class="mt-4 flex justify-center items-center"
            download="<?= basename($iCal) ?>"
            href="<?= $iCal ?>"
        >
            <?= useSVG($event->title(), 'w-6 h-6 fill-current', 'calendar-filled') ?>
            <span class="ml-2">
                <?= t('iCal-Datei herunterladen') ?>
            </span>
        </a>
    </p>
</div>
