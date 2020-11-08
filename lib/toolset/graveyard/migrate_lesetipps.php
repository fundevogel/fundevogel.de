<?php

include 'vendor/autoload.php';

# Init Kirby
$kirby = new Kirby([
    'roots' => [
        'base'     => $base = '.',
        'index'    => $base . '/public',
        'site'     => $base . '/site',
        'content'  => $base . '/content',
        'storage'  => $storage = $base . '/storage',
        'accounts' => $storage . '/accounts',
        'cache'    => $storage . '/cache',
        'sessions' => $storage . '/sessions',
    ]
]);


foreach (page('lesetipps')->children()->listed() as $p) {
    $kirby->impersonate('kirby');

    try {
        $data = loadBook($p->isbn()->value());

        $child = page('buecher')->createChild([
            'slug' => $p->slug(),
            'template' => 'book',
            'draft' => false,
            'content' => [
                'title' => $p->title()->value(),
                'description' => $data['Inhaltsbeschreibung'],
                'cover' => '',
                'isbn' => $p->isbn()->value(),
                'shop' => $p->shop()->value(),
                'book_title' => $p->book_title()->value(),
                'book_subtitle' => $p->book_subtitle()->value(),
                'author' => $p->author()->value(),
                'illustrator' => $p->illustrator()->value(),
                'narrator' => $p->narrator()->value(),
                'translator' => $p->translator()->value(),
                'participants' => $p->participants()->value(),
                'page_count' => $p->page_count()->value(),
                'publisher' => $p->publisher()->value(),
                'age' => $p->age()->value(),
                'price' => $p->price()->value(),
                'binding' => $p->binding()->value(),
                'categories' => $p->categories()->value(),
                'topics' => $p->topics()->value(),
                'hasAward' => $p->hasAward()->value(),
                'award' => $p->award()->value(),
                'awardEdition' => $p->awardEdition()->value(),
                'leselink' => $p->leselink()->value(),
                'isAudiobook' => $p->isAudiobook()->value(),
            ],
        ]);

        foreach ($p->files() as $file) {
            $file->copy($child);
        }

        $child->update([
            'cover' => Data::encode($p->cover()->yaml(), 'yaml'),
        ]);

        $p->update([
            'books' => Data::encode($child->id(), 'yaml'),
        ]);
    } catch (\Throwable $th) {
        continue;

    }
}
