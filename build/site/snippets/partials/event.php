<article class="wrap">
  <div class="two-thirds--wide">
    <h3><?= $event->summary()->html() ?></h3>
    <?= $event->description()->kt() ?>
  </div>
  <aside class="one-third--wide">
    <div class="card card--outer">
      <div class="card--inner">
        <h4><?= l::get('kalender_termin-ueberschrift') ?></h4>
        <p>
          <?php
            $location = $event->location();
            $type = $event->css();
            $start_time = $event->begin_time();
            $end_time = $event->end_time();
            $start_date = $year->title();
            $end_date = $event->end_date();
            $start = strtotime($start_date . ' ' . $start_time);
            $end = strtotime($event->end_date() . ' ' . $event->end_time());

            e($type->isNotEmpty(), l::get('kalender_termin-thema') . ': ' . $type->html() . '<br>');
            e($start, l::get('kalender_termin-tage') . ': ' . date('d.m.Y', $start) . '<br>');
            if($start_time->isNotEmpty()) {
              echo l::get('kalender_termin-zeit') . ': ' . date('H:i', $start);
              e($end_time && date('H:i', $end) !== date('H:i', $start), '- '. date('H:i', $end));
              echo ' ' . l::get('kalender_termin-uhr') . '<br>';
            }
            e($location->isNotEmpty(), l::get('kalender_termin-ort') . ': ' . $location->html() . '<br>');
            e($end_date && date('d.m.Y', $end) !== date('d.m.Y', $start), l::get('kalender_termin-ende') . ': ' . date('d.m.Y', $end));
          ?>
        </p>
      </div>
    </div>
  </aside>
</article>
