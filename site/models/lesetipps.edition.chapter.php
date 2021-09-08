<?php

class LesetippsEditionChapterPage extends Page {
    public function volume()
    {
        return $this->parent()->siblings()
                    ->unlisted()
                    ->find($this->parent()->year()->value());
    }


    public function subpages()
    {
        return Pages::factory($this->inventory()['children'], $this);
    }


    public function children()
    {
        $children = [];

        if ($file = $this->volume()->file(Str::slug($this->parent()->edition()->value()) . '.json')) {
            $count = 1;

            foreach (Json::read($file->root())[$this->title()->value()] as $book) {
                # Add books as children
                $title = $book['header'][1] ?? $book['header'][0];

                $children[] = [
                    'slug'     => Str::slug($title),
                    'num'      => $count,
                    'template' => 'lesetipps.edition.book',
                    'model'    => 'lesetipps.edition.book',
                    'content'  => [
                        'title'  => $title,
                        'isbn'   => $book['isbn'],
                        'author' => $book['header'][0],
                        'body'   => A::join($book['body'], "\n"),
                    ],
                ];

                $count++;
            }
        }

        return Pages::factory($children, $this);
    }
}
