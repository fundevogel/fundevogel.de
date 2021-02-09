<?php

use Biblys\Isbn\Isbn;

class LesetippsArticlePage extends Page {
    public function getCover() {
        $entries = $this->entries()->toStructure();

        foreach ($entries as $entry) {
            return $entry->book()->toPages()->first()->getCover();
        }
    }


    public function getBookCover(string $classes = '') {
        $entries = $this->entries()->toStructure();

        foreach ($entries as $entry) {
            return $entry->book()->toPages()->first()->getBookCover($classes);
        }
    }


    public function hasAward() {
        $entries = $this->entries()->toStructure();

        # Award-winning books are reviewed individually
        if (count($entries) > 1) {
            return false;
        }

        foreach ($entries as $entry) {
            return $entry->book()->toPages()->first()->hasAward()->bool();
        }
    }


    public function getAward() {
        $entries = $this->entries()->toStructure();

        foreach ($entries as $entry) {
            return $entry->book()->toPages()->first()->getAward();
        }
    }


    public static function create(array $props) {
        $isbn = $props['content']['title'];

        try {
            $isbn = new Isbn($props['content']['title']);

            # Check if valid ISBN was provided
            $isbn->validate();
            $isbn = $isbn->format('ISBN-13');

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
                'books' => Data::encode($book->id(), 'yaml'),
            ],
            'slug' => Str::slug($data['title']),
        ]));
    }
}
