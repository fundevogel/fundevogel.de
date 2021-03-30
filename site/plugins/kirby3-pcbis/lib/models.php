<?php

use Biblys\Isbn\Isbn;

class BookPage extends Page {
    public function isBook(string $classes = '') {
        return $this->intendedTemplate() == 'book.default';
    }


    public function isAudiobook(string $classes = '') {
        return $this->intendedTemplate() == 'book.audio';
    }


    public function isEbook(string $classes = '') {
        return $this->intendedTemplate() == 'book.ebook';
    }


    public function getBookCover(string $classes = '', bool $noLazy = true) {
        $image = $this->getCover();

        $preset = $image->orientation() === 'portrait'
            ? 'lesetipps.article.cover-normal'
            : 'lesetipps.article.cover-square'
        ;

        return $image->createImage($classes, $preset, false, $noLazy);
    }


    public function getAward() {
        $award = '';

        if (Str::contains(Str::lower($this->award()), 'lesepeter')) {
            $award = 'lesepeter';
        }

        if (Str::contains(Str::lower($this->award()), 'wolgast')) {
            $award = 'wolgast';
        }

        if ($award === '') {
            return [];
        }

        $array = site()->awards()
                       ->toStructure()
                       ->filterBy('identifier', $award)
                       ->first()
                       ->toArray();

        $array['awardlink'] = $this->leselink()->toUrl();
        $array['awardtitle'] = $this->award()->value() . ' ' . $this->awardEdition()->value();

        return $array;
    }


    public static function create(array $props) {
        $isbn = $props['content']['title'];

        try {
            # Check if valid ISBN was provided
            $isbn = Isbn::convertToIsbn13($isbn);

            # Fetch information from API
            $data = loadBook($isbn);

            # Get shop link
            $data['shop'] = getShopLink($isbn);
        } catch(\Exception $e) {
            return parent::create($props);
        }

        # Determine template
        $template = 'book.default';

        if (isset($data['type'])) {
            if ($data['type'] == 'Hörbuch') {
                $template = 'book.audio';
            }

            if ($data['type'] == 'ePublikation') {
                $template = 'book.ebook';
            }
        }

        return parent::create(array_merge($props, [
            'content' => $data,
            'slug' => Str::slug($data['title']) . ' ' . Str::slug($data['type']),
            'template' => $template,
        ]));
    }
}
