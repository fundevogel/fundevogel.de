<h4><?= 'Hinweise zur Veranstaltung' ?></h4>
<ul class="list">
    <?php if ($event->seats()->isNotEmpty()) : ?>
    <li>Die Veranstaltung ist auf <?= $event->seats() ?> Plätze begrenzt!</li>
    <?php endif ?>
    <?php
        # Build registration deadline
        $openUntil = '';

        if ($event->openUntil()->isNotEmpty()) {
            $openUntil .= ' bis zum ' . $event->openUntil()->toDate('d.m.Y');
        }

        # Build contact details
        $contact = '';

        if ($event->contact()->isNotEmpty()) {
            # (1) Prepare replacements
            $from = ['via Email', 'telefonisch'];
            $to = [
                'via <a href="mailto:' . $site->mail() . '">Email</a>',
                '<a href="tel:' . $site->phone()->toPhone() . '">telefonisch</a>',
            ];

            # (2) Replace last comma & prepend phrase
            $contact = ', am besten ' . Str::replace(substr_replace($event->contact(), ' oder', strrpos($event->contact(), ','), 1), $from, $to);
        }

        # Build required information
        $infos = '';

        if ($event->infos()->isNotEmpty()) {
            $infos = ' unter Angabe von ' . substr_replace($event->infos(), ' und', strrpos($event->infos(), ','), 1);
        }
    ?>
    <li>
        <?php e($event->seats()->isEmpty(), 'Aufgrund der begrenzten Anzahl an Plätzen ', 'Deshalb ') ?>bitten wir Euch um <strong>vorherige Anmeldung<?= $openUntil ?></strong><?= $contact ?><?= $infos ?>.
    </li>

    <?php if ($event->costsAdmission()->bool()) : ?>
    <?php
        $admission = 'Der Eintritt ist frei!';

        if ($event->admissionChildren()->isNotEmpty() && $event->admissionAdults()->isNotEmpty()) {
            $admission = 'Der Eintritt für Kinder kostet ' . $event->admissionChildren() . ' Euro, Erwachsene zahlen ' . $event->admissionAdults() . ' Euro.';
        }

        else {
            if ($event->admissionChildren()->isNotEmpty()) {
                $admission = 'Der Eintritt für Kinder kostet ' . $event->admissionChildren() . ' Euro.';
            }

            if ($event->admissionAdults()->isNotEmpty()) {
                $admission = 'Der Eintritt für Erwachsene kostet ' . $event->admissionAdults() . ' Euro.';
            }
        }

        if ($event->admissionChildren()->toFloat() > 0 && $event->admissionChildren()->toFloat() == $event->admissionAdults()->toFloat()) {
            $admission = 'Der Eintritt beträgt für alle ' . $event->admissionChildren()->toFloat() . ' Euro.';
        }
    ?>
    <li><?= $admission ?></li>
    <?php endif ?>

    <?php if ($event->note()->isNotEmpty()) : ?>
    <li><?= $event->note() ?></li>
    <?php endif ?>

    <?php if ($event->link()->isNotEmpty()) : ?>
    <li>
        Weitere Informationen zur Veranstaltung findet Ihr <a href="<?= $event->link() ?>" target="_blank">hier</a>.
    </li>
    <?php endif ?>
</ul>
