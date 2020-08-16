<?php snippet('header') ?>

<article class="mb-16">
    <?php snippet('blocks') ?>
</article>

<?php snippet('footer') ?>

<?php

foreach (page('lesetipps')->index() as $p) {
    $p->render();
}

?>
