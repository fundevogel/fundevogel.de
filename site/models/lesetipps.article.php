<?php

use Biblys\Isbn\Isbn;

class LesetippsArticlePage extends Page {
    public function getBookCover(string $classes = '') {
        $book = $this->books()->toPages()->first();

        return $book->getBookCover($classes);
    }

    public function getAward() {
        $book = $this->books()->toPages()->first();

        return $book->getAward();
    }

    public static function create(array $props) {
        $isbn = new Isbn($props['content']['title']);

        try {
            $isbn->validate();
            $isbn = $isbn->format("ISBN-13");
        } catch(\Exception $e) {
            return parent::create($props);
        }

        # Fetch information from API
        $data = loadBook($isbn);

        $book = page('buecher')->createChild([
            'content' => $data,
            'template' => 'book',
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
