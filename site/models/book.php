<?php

use Biblys\Isbn\Isbn;

class BookPage extends Page {
    public function getBookCover(string $classes = '') {
        $image = $this->getCover();

        $preset = $image->orientation() === 'portrait'
            ? 'lesetipps.article.cover-normal'
            : 'lesetipps.article.cover-square'
        ;

        return $image->createImage($classes, $preset);
    }

    public function getAward() {
        $award = '';

        if (Str::contains(Str::slug($this->award()), 'lesepeter')) {
            $award = 'lesepeter';
        }

        if (Str::contains(Str::slug($this->award()), 'wolgast')) {
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

        return parent::create(array_merge($props, [
            'content' => $dataArray,
            'slug' => Str::slug($data['Titel']),
        ]));
    }
}
