<?php

class LesetippsArticlePage extends Page {
    public static function hookPageCreate($page) {
        # TODO: Replace with janitor task `loadBook` (they are practically the same)
        # API call
        $isbn = $page->isbn()->value();
        $data = loadBook($isbn);

        $dataArray = [
            'book_title' => $data['Titel'],
            'book_subtitle' => $data['Untertitel'],
            'author' => $data['AutorIn'],
            'participants' => $data['Mitwirkende'],
            'publisher' => $data['Verlag'],
            'age' => $data['Altersempfehlung'],
            'page_count' => $data['Seitenzahl'],
            'price' => $data['Preis'],
            'binding' => $data['Einband'],
            'categories' => $data['Kategorien'],
            'topics' => $data['Schlagworte'],
            'shop' => rtrim(getShopLink($isbn), '01234567890/'),
        ];

        $page->updateBook($dataArray);

        try {
            $page->changeSlug(Str::slug($data['Titel']));
        } catch (Kirby\Exception\DuplicateException $e) {
            $page->delete(true);
        } catch (Exception $e) {}
    }

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
}
