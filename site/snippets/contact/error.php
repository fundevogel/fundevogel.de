<?php if (count($form->errors()) > 0) : ?>
<div class="mb-8">
    <?= $page->formError()->kt() ?>

    <ul class="list">
        <?php foreach ($form->errors() as $error) : ?>
        <li class="font-medium"><?= implode('<br>', $error) ?></li>
        <?php endforeach ?>
    </ul>
</div>
<?php endif ?>
