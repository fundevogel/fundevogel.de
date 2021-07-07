<h3><?= t('Öffnungszeiten') ?></h3>
<p><?= t('Montag bis Freitag') ?>: <?= $page->weekStart()->time2local(false) ?> - <?= $page->weekEnd()->time2local(true) ?></p>
<p><?= t('Samstag') ?>: <?= $page->weekendStart()->time2local(false) ?> - <?= $page->weekendEnd()->time2local(true) ?></p>
