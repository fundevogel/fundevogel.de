<?php

class LesetippsEditionPage extends Page {
    public function volume()
    {
        return $this->siblings()->unlisted()->find($this->year()->value());
    }


    public function pdf()
    {
        return $this->volume()->files()->filterBy('edition', $this->edition()->value())->first();
    }


    public function getFront(string $classes = '')
    {
        return $this->pdf()->getFront($classes);
    }


    public function subpages()
    {
        return Pages::factory($this->inventory()['children'], $this);
    }


    public function children()
    {
        $children = [];

        if ($file = $this->volume()->file(Str::slug($this->edition()->value()) . '.json')) {
            $count = 1;

            foreach (Json::read($file->root()) as $chapter => $books) {
                $data = [];

                # Add books to chapters ..
                foreach ($books as $book) {
                    $data[] = [
                        'title' => $book['header'][1] ?? $book['header'][0],
                        'author' => $book['header'][0],
                        'isbn' => $book['isbn'],
                        'body' => A::join($book['body'], "\n"),
                    ];
                }

                # .. and chapters as children
                $children[] = [
                    'slug'     => Str::slug($chapter),
                    'num'      => $count,
                    'template' => 'lesetipps.edition.chapter',
                    'model'    => 'lesetipps.edition.chapter',
                    'content'  => [
                        'title' => $chapter,
                        'books' => Yaml::encode($data),
                    ],
                ];

                $count++;
            }
        }

        return Pages::factory($children, $this);
    }
}
