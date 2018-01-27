<?php
  $pdf = @$early ? $page->pdf_spring() : $page->pdf_autumn();
  $image = @$early ? $page->image_spring()->toFile() : $page->image_autumn()->toFile();
  if ($pdf->isNotEmpty() && $image) :
?>
<figure class="fig">
  <a href="<?= $page->file($pdf)->url() ?>" target="_blank">
    <img src="<?= $image->url() ?>" title="<?= $image->caption() ?>" alt="<?= $image->alt() ?>" width="<?= $image->width() ?>" height="<?= $image->height() ?>">
    <figcaption class="bg--primary"><?= $image->caption() ?></figcaption>
  </a>
</figure>
<?php endif ?>
