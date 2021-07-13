<strong><?= $page->blueprint()->field($field)['label'] ?></strong>
<ul class="list">
    <?php foreach ($page->$field()->toStructure() as $library) : ?>
    <?php
        # Check if license is available
        $hasLicense = $library->license()->isNotEmpty();

        # Take care of libraries not yet available via API
        if ($library->url()->isNotEmpty()) {
            $tag = Html::a($library->url(), $library->name()->html(), [
                'class' => $hasLicense ? 'js-tippy' : '',
                'title' => $hasLicense ? A::join([t('Lizenz'), $library->license()], ': ') : '',
                'target' => '_blank',
            ]);

        } else {
            $tag = Html::tag('span', $library->name()->html(), [
                'class' => $hasLicense ? 'js-tippy' : '',
                'title' => $hasLicense ? A::join([t('Lizenz'), $library->license()], ': ') : '',
            ]);
        }
    ?>
    <li>
        <?= $library->maintainer() ?>/<?= $tag ?><?php e($library->version()->isNotEmpty(), ' (v' . $library->version() . ')') ?>
    </li>
    <?php endforeach ?>
</ul>
