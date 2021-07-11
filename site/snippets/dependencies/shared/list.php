<strong><?= $title ?></strong>
<ul class="list">
    <?php foreach ($data as $library) : ?>
    <?php
        if (!isset($library['url'])) {
            $tag = Html::tag('span', $library['name'], [
                'class' => isset($library['license']) ? 'js-tippy' : '',
                'title' => isset($library['license']) ? A::join([t('Lizenz'), $library['license']], ': ') : '',
            ]);

        } else {
            $tag = Html::a($library['url'], $library['name'], [
                'class' => isset($library['license']) ? 'js-tippy' : '',
                'title' => isset($library['license']) ? A::join([t('Lizenz'), $library['license']], ': ') : '',
                'target' => '_blank',
            ]);
        }
    ?>
    <li>
        <?= $library['maintainer'] ?>/<?= $tag ?> (v<?= $library['version'] ?>)
    </li>
    <?php endforeach ?>
</ul>
