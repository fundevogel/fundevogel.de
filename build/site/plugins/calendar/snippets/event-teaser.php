<article class="wrap">
  <div class="two-thirds--wide">
    <h3><?= $event->summary()->escape() ?></h3>
    <?= $event->description()->kirbytext() ?>
  </div>
  <aside class="one-third--wide">
    <div class="card card--outer">
      <div class="card--inner">
        <h4><?= l::get('kalender_termin-ueberschrift') ?></h4>
        <p>
          <?php $begin_date = strtotime($event->begin_date()); ?>
          <?php $end_date = strtotime($event->end_date()); ?>

          <?= l::get('kalender_termin-thema') ?>: <?= $event->what()->html() ?><br>
          <?= l::get('kalender_termin-tage') ?>: <?= date('d.m.Y', $begin_date) ?><br>
          <?php if($event->begin_time()->isNotEmpty()) : ?>
          <?= l::get('kalender_termin-zeit') ?>: <?= $event->begin_time() ?> <?php if($event->end_time()->isNotEmpty()) : ?>bis <?= $event->end_time() ?><?php endif ?>Uhr<br>
          <?php endif ?>
          <?= l::get('kalender_termin-ort') ?>: <?= $event->location()->html() ?><br>
          <?php if($end_date && $end_date !== $begin_date) : ?>
          <?= l::get('kalender_termin-ende') ?>: <?= date('d.m.Y', $end_date) ?><br>
          <?php endif ?>
        </p>
      </div>
    </div>
  </aside>
</article>
