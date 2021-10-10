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
        ?>
        <a
            class="mt-4 flex justify-center items-center"
            href="<?= $event->url() . '.ics' ?>"
            data-barba-prevent="self"
        >
            <?= useSVG($event->title(), 'w-6 h-6 fill-current', 'calendar-filled') ?>
            <span class="ml-2">
                <?= t('iCal-Datei herunterladen') ?>
            </span>
        </a>
        <?php
            # Build link to OpenStreetMap
            # (1) Get coordinates
            $coordinates = $event->coordinates()->toLocation();

            # (2) Fetch URL
            $geoURL = '';

            if ($coordinates->isNotEmpty()) {
                $geoURL = geo2osm($coordinates->lat(), $coordinates->lon());
            }

            if (!empty($geoURL)) :
        ?>
        <a
            class="mt-2 flex justify-center items-center"
            href="<?= $geoURL ?>"
        >
            <?= useSVG($event->location(), 'w-6 h-6 fill-current', 'map-filled') ?>
            <span class="ml-2">OpenStreetMap</span>
        </a>
        <?php endif ?>
    </p>
</div>
