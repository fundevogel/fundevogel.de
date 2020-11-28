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

        $dataArray = [
            'title' => $data['Titel'],
            'book_title' => $data['Titel'],
            'book_subtitle' => $data['Untertitel'],
            'isbn' => $props['slug'],
            'author' => $data['AutorIn'],
            'participants' => $data['Mitwirkende'],
            'publisher' => $data['Verlag'],
            'age' => $data['Altersempfehlung'],
            'page_count' => $data['Seitenzahl'],
            'price' => $data['Preis'],
            'binding' => $data['Einband'],
            'description' => $data['Inhaltsbeschreibung'],
            'topics' => $data['Schlagworte'],
            'isAudiobook' => false,
            'shop' => rtrim(getShopLink($isbn), '01234567890/'),
        ];

        if (Str::contains($data['Untertitel'], ' Min.')) {
            $dataArray['isAudiobook'] = true;
        }

        $book = page('buecher')->createChild([
            'content' => $dataArray,
            'template' => 'book',
        ]);

        return parent::create(array_merge($props, [
            'content' => [
                'title' => $data['Titel'],
                'books' => Data::encode($book->id(), 'yaml'),
            ],
            'slug' => Str::slug($data['Titel']),
        ]));
    }
}
