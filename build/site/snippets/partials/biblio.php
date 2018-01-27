<?= $item->verdict()->kt() ?>
<blockquote>
  <?= $item->titel()->html() ?><br>
  <?= $item->autor()->html() ?><br>
  <?= $item->verlag()->html() ?><br>
  ISBN <?= $item->isbn()->html() ?><br>
  <?= $item->preis()->html() ?> €<?php e($item->alter()->isNotEmpty(), '; ' . $item->alter()->html()) ?>
</blockquote>
