<div class="card card--outer">
  <div class="card--inner">
    <h4><?= t('kalender_termin-ueberschrift') ?></h4>
    <p>
    <?php
      // $key = md5($event->id() . $event->modified());
      //
      // $data = lapse($key, function () use ($location) {
      //     return $location->getGeolocation();
      // }, 60);

      $location = $event->location();
      $geoLink = 'https://www.openstreetmap.org/search?query=' . str::slug($location);

      if (str::contains(str::slug($location), 'fundevogel')) {
          $geoLink = 'https://www.openstreetmap.org/node/679144412';
      }

      $geoTag = Html::tag('a', t('lesetipps_weiterlesen'), [
          'href' => $geoLink,
      ]);

      $category = $event->category();
      $start_time = $event->begin_time();
      $end_time = $event->end_time();
      $start_date = $event->date();
      $end_date = $event->end_date();
      $start = strtotime($start_date . ' ' . $start_time);
      $end = strtotime($event->end_date() . ' ' . $event->end_time());

      e($category->isNotEmpty(), t('kalender_termin-thema') . ': ' . $category->html() . '<br>');
      e($start, t('kalender_termin-tage') . ': ' . date('d.m.Y', $start) . '<br>');
      if($start_time->isNotEmpty()) {
          echo t('kalender_termin-zeit') . ': ' . date('H:i', $start);
          e($end_time && date('H:i', $end) !== date('H:i', $start), '- '. date('H:i', $end));
          echo ' ' . t('kalender_termin-uhr') . '<br>';
      }

      e($location->isNotEmpty(), t('kalender_termin-ort') . ': ' . $location->html() . ' (' . $geoTag . ')<br>');
      e($end_date && date('d.m.Y', $end) !== date('d.m.Y', $start), t('kalender_termin-ende') . ': ' . date('d.m.Y', $end));
    ?>
    </p>
  </div>
</div>
