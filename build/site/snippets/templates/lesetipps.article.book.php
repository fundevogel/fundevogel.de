<?= $lesetipp->verdict()->kt() ?>
<blockquote>
  <?= $lesetipp->titel()->html() ?><br>
  <?= $lesetipp->autor()->html() ?><br>
  <?= $lesetipp->verlag()->html() ?><br>
  ISBN <?= $lesetipp->isbn()->html() ?><br>
  <?= $lesetipp->preis()->html() ?> €<?php e($lesetipp->alter()->isNotEmpty(), '; ' . $lesetipp->alter()->html()) ?>
</blockquote>
