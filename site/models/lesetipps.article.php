<?php

use Biblys\Isbn\Isbn;

class LesetippsArticlePage extends Page {
    public function getCover() {
        return $this->book()->toPage()->getCover();
    }


    public function getBookCover(string $classes = '', bool $noLazy = true) {
        return $this->book()->toPage()->getBookCover($classes, $noLazy);
    }


    public function hasAward(): bool {
        if ($this->book()->isEmpty()) {
            return false;
        }

        return $this->book()->toPage()->hasAward()->bool();
    }


    public function getAward() {
        return $this->book()->toPage()->getAward();
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

        if ($data['type'] == 'Hörbuch') {
            $template = 'book.audio';
        }

        if ($data['type'] == 'ePublikation') {
            $template = 'book.ebook';
        }

        $book = page('buecher')->createChild([
            'content' => $data,
            'slug' => Str::slug($data['title']) . ' ' . Str::slug($data['type']),
            'template' => $template,
        ]);

        return parent::create(array_merge($props, [
            'content' => [
                'title' => $data['title'],
                'book' => Data::encode($book->id(), 'yaml'),
            ],
            'slug' => Str::slug($data['title']),
        ]));
    }
}
