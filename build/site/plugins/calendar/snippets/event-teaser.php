<article class="wrap">
  <div class="two-thirds--wide">
    <h3><?= $event->summary()->escape() ?></h3>
    <?= $event->description()->kirbytext() ?>
  </div>
  <aside class="one-third--wide">
    <div class="card card--outer">
      <div class="card--inner">
        <h4>Termin im Überblick</h4>
        <p>
          <?php $begin_date = strtotime($event->begin_date()); ?>
          <?php $end_date = strtotime($event->end_date()); ?>

          Was: <?= $event->what()->html() ?><br>
          Wann: <?= date('d.m.Y', $begin_date) ?><br>
          <?php if($event->begin_time()->isNotEmpty()) : ?>
          Zeit: <?= $event->begin_time() ?> <?php if($event->end_time()->isNotEmpty()) : ?>bis <?= $event->end_time() ?><?php endif ?>Uhr<br>
          <?php endif ?>
          Ort: <?= $event->location()->html() ?><br>
          <?php if($end_date && $end_date !== $begin_date) : ?>
          Ende: <?= date('d.m.Y', $end_date) ?><br>
          <?php endif ?>
        </p>
      </div>
    </div>
  </aside>
</article>
