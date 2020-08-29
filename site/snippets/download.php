<div class="inset-0 w-full h-full absolute opacity-0 group-hover:opacity-100 rounded-lg bg-gradient-to-tr from-red-medium to-orange-medium transition-all z-25">
    <div class="h-full flex flex-col justify-center items-center">
        <?= useSVG('Download', 'w-10 md:w-12 h-auto text-white fill-current', 'download') ?>
        <span class="font-normal text-lg lg:text-xl xl:text-2xl text-white">Download</span>
        <span class="mt-1 font-normal text-xs xl:text-sm text-white"><?= $file->niceSize() ?><?php e($file->type() === 'image', ' - ' . $file->width() . ' x ' . $file->height()) ?></span>
    </div>
</div>
