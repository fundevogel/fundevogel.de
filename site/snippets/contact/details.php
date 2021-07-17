<?php if ($type === 'contact') : ?>
<h3><?= t('Kontaktinfos') ?></h3>
<p>Marienstraße 13, 79098 Freiburg</p>
<p><?= t('Telefon') ?>: <?= $site->phone() ?> &middot; <?= t('Fax') ?>: <?= $site->fax() ?></p>
<p>Mail: <?= $site->mail() ?></p>
<?php
    endif;
    if ($type === 'hours') :
?>
<h3><?= t('Öffnungszeiten') ?></h3>
<p><?= t('Montag bis Freitag') ?>: <?= $page->weekStart()->time2local(false) ?> - <?= $page->weekEnd()->time2local(true) ?></p>
<p><?= t('Samstag') ?>: <?= $page->weekendStart()->time2local(false) ?> - <?= $page->weekendEnd()->time2local(true) ?></p>
<?php endif ?>
