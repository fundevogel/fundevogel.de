<aside class="container">
    <div class="mt-12 card is-dashed">
        <h3 class="mb-4 underline"><?= t('Über LesePeter') ?></h3>
        <div class="flex items-center">
            <div class="flex-1">
                <?= (new Field(null, 'desc', $award['description']))->kirbytext() ?>
            </div>
            <div class="flex-none">
                <?php
                    $image = new File([
                        'parent' => $site,
                        'filename' => 'lesepeter.png',
                    ]);
                    $preset = 'lesepeter.mascot';
                    $resized = $image->thumb($preset);
                ?>
                <?php
                    snippet('webPicture', [
                        'src' => $image,
                        'tag' => Html::img($resized->url(), [
                            'class' => 'js-tippy ml-6 w-auto h-48 lg:h-64 hidden md:block cursor-help',
                            'title' => 'Daumen hoch für gute Bücher!',
                            'alt'=> 'LesePeter-Logo',
                            'width' => $resized->width(),
                            'height' => $resized->height(),
                            'data-tippy-theme' => 'fundevogel red',
                        ]),
                        'sizes' => option('thumbs.sizes')[$preset],
                        'preset' => $preset,
                    ]);
                ?>
            </div>
        </div>
    </div>
</aside>
