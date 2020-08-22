<strong><?= $title ?></strong>
<ul class="list">
    <?php
        foreach ($data as $library) :
        $link = Html::a($library['url'], $library['repo'], [
            'class' => $library['license'] ? 'js-tippy' : '',
            'title' => $library['license'] ? A::join([t('Lizenz'), $library['license']], ': ') : '',
            'target' => '_blank',
        ]);
    ?>
    <li>
        <?= $library['maintainer'] ?>/<?= $link ?> (v<?= $library['version'] ?>)
    </li>
    <?php endforeach ?>
</ul>
