<strong><?= $title ?></strong>
<ul class="list">
    <?php
        foreach ($data as $library) :
        $link = Html::a($library['url'], $library['name'], [
            'class' => $library['license'] ? 'js-tippy' : '',
            'title' => $library['license'] ? implode(': ', [t('Lizenz'), $library['license']]) : '',
            'target' => '_blank',
        ]);
    ?>
    <li>
        <?= $library['author'] ?>/<?= $link ?> (v<?= $library['version'] ?>)
        <p class="content">
            <?= $library['desc'] ?>
        </p>
    </li>
    <?php endforeach ?>
</ul>
