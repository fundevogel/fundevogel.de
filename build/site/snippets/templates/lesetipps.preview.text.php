<time datetime="<?= $lesetipp->date()->toDate('Y-m-d') ?>"><?= $lesetipp->date()->toDate('d.m.Y') ?></time>
<h3><a href="<?= $lesetipp->url() ?>"><?= $lesetipp->title()->html() ?></a></h3>
<p><?= $lesetipp->moreLink() ?></p>
