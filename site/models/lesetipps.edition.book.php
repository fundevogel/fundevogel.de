<?php

class LesetippsEditionBookPage extends Page {
    public function getCover()
    {
        $fileName = Str::slug($this->title()->value()) . '.jpg';

        return $this->parent()->volume()->images()->find($fileName)
            ? $this->parent()->volume()->image($fileName)
            : page('lesetipps')->fallback()->toFile()
        ;
    }


    public function text()
    {
        return Str::replace($this->body()->value(), ["\n", '-'], ['</p><p class="content">', '']);
    }


    public function getBookCover(string $classes = '', bool $noLazy = true) {
        $image = $this->getCover();

        $preset = $image->orientation() === 'portrait'
            ? 'lesetipps.article.cover-normal'
            : 'lesetipps.article.cover-square'
        ;

        return $image->createImage($classes, $preset, false, $noLazy);
    }
}
