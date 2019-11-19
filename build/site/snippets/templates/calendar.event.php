<article class="wrap">
  <div class="two-thirds--wide">
    <h3><?= $event->title()->html() ?></h3>
    <?= $event->text()->kt() ?>
  </div>
  <aside class="one-third--wide">
    <?php snippet('templates/calendar.event.card', compact('event')) ?>
  </aside>
</article>
<?php e($event !== $last, '<hr>'); ?>
