<?php
    $years = $page->documents()->sortBy('year', 'desc', 'edition', 'asc')->groupBy('year');
?>
<div class="modal" data-modal="archive">
  <div class="modal-overlay"></div>
  <div class="modal-card card card--outer">
    <div class="card--inner">
      <div class="wrap">
      <?php foreach ($years as $year => $files) : ?>
        <div>
          <h4><?= $year ?></h4>
          <?php
              foreach ($files as $file) {
                  snippet('templates/lesetipps/editions.pdf', [
                      'file' => $file,
                      'image' => $file->getCover()
                  ]);
              }
          ?>
        </div>
      <?php endforeach ?>
      </div>
    </div>
  </div>
</div>
