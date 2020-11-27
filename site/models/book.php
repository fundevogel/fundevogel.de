<?php

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
        $isbn = $props['content']['title'];

        try {
            # Fetch information from API
            $data = loadBook($isbn);
        } catch(\Exception $e) {
            return parent::create($props);
        }

        return parent::create(array_merge($props, [
            'content' => $data,
            'slug' => Str::slug($data['title']),
        ]));
    }
}
