<div class="flex flex-col justify-center">
    <?php if ($article->books()->isNotEmpty()) : ?>
        <?php
            snippet('components/book-wave', [
                'heading' => t('Unsere Bücher des Monats') . '<br>"' . $article->month()->value() . '"',
                'icon' => 'star',
                'data' => $article->books()->toStructure(),
        ])
    ?>
    <?php endif ?>
</div>
