<?php
    # Available variables
    # 'heading'
    # 'icon'
    # 'text'
    # 'data'

    # Determine data type
    if (is_a($data, 'Kirby\Cms\Page')) {
        $data = (new Pages())->add($data);
    }

    $hasMultiple = count($data) > 1;

    # Setup default values
    $heading = $heading ?? '';

    if (isset($heading) && is_a($heading, 'Kirby\Cms\Field')) {
        $heading = $heading->html();
    }

    $icon = $icon ?? '';

    if (isset($icon) && is_a($icon, 'Kirby\Cms\Field')) {
        $icon = $icon->value();
    }
?>
<aside class="wave">
    <?= useSeparator('orange-light', 'top-reversed') ?>
    <div class="inner">
        <?php if ($heading != '') : ?>
        <?php if ($icon != '') : ?>
        <div class="text-center">
            <?= useSVG($heading, 'title-icon', $icon) ?>
        </div>
        <?php endif ?>
        <h2 class="title text-orange-medium"><?= $heading ?></h2>
        <?php endif ?>
        <?php
            # Enable slide functionality for multiple items only
            e($hasMultiple, '<div class="js-slider overflow-hidden">');
        ?>
        <div class="py-8 flex">
            <?php
                foreach ($data as $item) :

                $book = $item->book()->toPage();
                $title = $item->title()->or($book->title())->html();
                $text = $item->text()->or($book->description())->kt();

                if (isset($verdict)) {
                    $text = $verdict->kt();
                }
            ?>
            <div class="min-w-full flex flex-col justify-center relative">
                <div class="container lg:px-8 xl:px-12">
                    <div class="flex flex-col lg:flex-row">
                        <div class="flex-none flex justify-center">
                            <div class="flex items-center mb-10 lg:mb-0">
                                <?php if (isset($useTaxonomy) && $useTaxonomy === true) : ?>
                                <div class="group relative">
                                    <?= $book->getBookCover('rounded-lg') ?>
                                    <div class="inset-0 w-full h-full absolute opacity-0 group-hover:opacity-100 rounded-lg bg-orange-medium text-shadow cursor-context-menu transition-all spread-out">
                                        <div class="pt-8 px-4">
                                            <div class="taxonomy">
                                                <div class="mb-1 flex items-center">
                                                    <?= useSVG('Kategorien', 'taxonomy-icon', 'folder') ?>
                                                    <h4 class="taxonomy-title"><?= t('Einteilung') ?>:</h4>
                                                </div>
                                                <?php
                                                    $categories = $book->categories()->split();
                                                    $topics = $book->topics()->split();
                                                ?>
                                                <div class="taxonomy-body">
                                                    <?php foreach ($categories as $category): ?>
                                                    <a href="<?= url('lesetipps', ['params' => ['Kategorie' => rawurlencode($category)]]) ?>">
                                                        <span><?= $category ?></span>
                                                    </a>
                                                    <?php e(A::last($categories) === $category, '', ',&nbsp;') ?>
                                                    <?php endforeach ?>
                                                </div>
                                            </div>
                                            <div class="taxonomy">
                                                <div class="mb-1 flex items-center">
                                                    <?= useSVG('Themen', 'taxonomy-icon', 'tag') ?>
                                                    <h4 class="taxonomy-title"><?= t('Themen') ?>:</h4>
                                                </div>
                                                <div class="taxonomy-body">
                                                    <?php foreach ($topics as $topic) : ?>
                                                        <a class="inline" href="<?= url('lesetipps', ['params' => ['Thema' => rawurlencode($topic)]]) ?>">
                                                            <span><?= $topic ?></span>
                                                        </a>
                                                        <?php e(A::last($topics) === $topic, '', ',&nbsp;') ?>
                                                    <?php endforeach ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="-top-5 -left-5 absolute">
                                        <?= useSVG('Mehr anzeigen', 'w-10 h-10 p-2 text-white fill-current bg-red-medium rounded-full', 'plus') ?>
                                    </span>
                                </div>
                                <?php else : ?>
                                <a class="group relative rounded-lg" href="<?php e($book->isAvailable()->bool() && $book->shop()->isNotEmpty(), $book->shop(), 'mailto:' . $site->mail()) ?>" target="_blank">
                                    <?php if ($book->isSeries()->bool()) : ?>
                                    <span class="badge bg-red-medium absolute top-4 -left-6 z-10">
                                        <?= t('Serie') ?>
                                    </span>
                                    <?php endif ?>
                                    <?= $book->getBookCover('rounded-lg') ?>
                                    <?php snippet('components/shared/gradient-overlay', ['data' => $book]) ?>
                                </a>
                                <?php endif ?>
                            </div>
                        </div>

                        <?php if (isset($useDetails) && $useDetails === true) : ?>
                        <div class="flex-1 md:ml-16">
                            <div class="lg:text-lg"><?= $text ?></div>
                            <?php snippet('components/shared/book-details', compact('book')) ?>
                        </div>
                        <?php else : ?>
                        <div class="md:ml-16 flex-1 flex flex-col justify-center">
                            <div class="mb-6">
                                <h3 class="lg:text-2xl text-orange-medium"><?= $title ?></h3>
                                <div class="lg:text-lg"><?= $text ?></div>
                                <?php
                                    # TODO: Remove legacy code for template 'assortment.single'
                                    if ($item->quote()->isNotEmpty()) {
                                        echo kirbytag([
                                            'quote'  => $item->quote()->html(),
                                            'author'  => $item->person()->html(),
                                            'color' => 'orange',
                                        ]);
                                    }
                                ?>
                            </div>
                        </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <?php endforeach ?>
        </div>
        <?php
            # Enable slide navigation for multiple items only
            if ($hasMultiple) :
        ?>
        <div class="js-controls mt-12 mb-px flex justify-center">
            <?php
                foreach ($data as $item) :

                $book = $item->book()->toPage();
                $title = $item->title()->or($book->title())->html();
            ?>
            <span
                class="js-tippy mx-1 inline-block w-4 h-4 bg-red-light hover:bg-red-medium rounded-full cursor-pointer transition-all"
                title="<?= $title ?>"
                data-tippy-placement="bottom"
                data-tippy-theme="fundevogel red"
            ></span>
            <?php endforeach ?>
        </div>
        <?php endif ?>
        <?php e($hasMultiple, '</div>') ?>
    </div>
    <?= useSeparator('orange-light', 'bottom-reversed') ?>
</aside>
