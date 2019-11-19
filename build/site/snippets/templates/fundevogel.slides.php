<figure class="fig fig--slider has-hover">
  <div class="lightgallery gallery">
    <?php foreach ($page->images() as $image) : ?>
    <?php snippet('templates/fundevogel.slides.image', ['image' => $image, 'lightgallery' => true]) ?>
    <?php endforeach ?>
  </div>
  <?php snippet('templates/fundevogel.slides.caption') ?>
</figure>
<noscript>
  <figure class="fig has-hover">
    <?php
      snippet('templates/fundevogel.slides.image');
      snippet('templates/fundevogel.slides.caption');
    ?>
  </figure>
</noscript>
