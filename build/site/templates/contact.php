<?php snippet('header') ?>

<section class="wrap center">
  <div class="one-half">
    <?= $page->kontaktinfos()->kt() ?>
    <?= $page->oeffnungszeiten()->kt() ?>
  </div>
  <div class="one-half">
    <?php snippet('templates/contact.map') ?>
  </div>
</section>
<hr>
<section class="list wrap">
  <h2><?= t('kontakt_ueberschrift-liste') ?></h2>
  <div class="one-third">
    <div class="center">
      <svg role="img" title="Fahrrad" width="80" height="41.5">
        <use xlink:href="/assets/images/icons.svg#bike"></use>
      </svg>
    </div>
    <?= $page->bike()->kt() ?>
  </div>
  <div class="one-third">
    <div class="center">
      <svg role="img" title="Auto" width="92.5" height="52.5">
        <use xlink:href="/assets/images/icons.svg#car"></use>
      </svg>
    </div>
    <?= $page->auto()->kt() ?>
  </div>
  <div class="one-third">
    <div class="center">
      <svg role="img" title="Straßenbahn" width="78" height="56">
        <use xlink:href="/assets/images/icons.svg#tram"></use>
      </svg>
    </div>
    <?= $page->tram()->kt() ?>
  </div>
</section>

<?php snippet('footer') ?>
