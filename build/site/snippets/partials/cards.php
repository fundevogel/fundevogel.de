<div id="macy" class="macy">
  <?php foreach($item as $entry) : ?>
    <article class="card card--outer">
      <div class="card--inner">
        <?= $entry->description()->kt() ?>
      </div>
    </article>
  <?php endforeach ?>
</div>
