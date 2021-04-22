<div class="flex flex-col justify-center">
    <?php if ($article->books()->isNotEmpty()) : ?>
        <?php
            snippet('components/book-wave', [
                'heading' => t('Bücher zum Thema') . '<br>"' . $article->title()->html() . '"',
                'icon' => 'star',
                'data' => $article->books()->toStructure(),
        ])
    ?>
    <?php endif ?>
</div>
