<?php
    # Available variables
    # 'text'
    # 'author'
    # 'color'

    # Setup default values
    if (!is_string($text)) {
        $text = $text->kti();
    }

    if (!isset($color)) {
        $color = '';
    }

    if (is_a($color, 'Kirby\Cms\Field')) {
        $color = $color->value();
    }

    $color = $color != '' ? $color : 'red';

    if (!isset($author)) {
        $author = '';
    }

    if (is_a($author, 'Kirby\Cms\Field')) {
        $author = $author->html();
    }
?>
<blockquote class="p-0 border-0">
    <p class="content">
        <?= $text ?>
    </p>
    <?php if ($author != ''): ?>
    <footer>
        <?= useSVG(t('quote'), 'inline w-6 h-6 -mt-1 mr-1 text-' . $color . '-medium fill-current', 'message-filled') ?>
        <span class="text-sm text-<?= $color ?>-medium not-italic font-normal">
            <?= $author ?>
        </span>
    </footer>
    <?php endif ?>
</blockquote>
