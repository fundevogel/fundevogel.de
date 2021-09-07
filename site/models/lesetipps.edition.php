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
            # Load JSON data
            $data = Json::read($file->root());

            $count = 1;

            foreach ($data as $chapter => $books) {
                $data = [];

                # Add books to chapters ..
                foreach ($books as $book) {
                    $data[] = [
                        'title' => $book['header'][1] ?? $book['header'][0],
                        'author' => $book['header'][0],
                        'isbn' => $book['isbn'],
                        'body' => $book['body'],
                    ];
                }

                # .. and chapters as children
                $children[] = [
                    'slug'     => Str::slug($chapter),
                    'num'      => $count,
                    'template' => 'lesetipps.edition.chapter',
                    'model'    => 'lesetipps.edition.chapter',
                    'files'    => $this->parent()->images()->toArray(),
                    'content'  => [
                        'title' => $chapter,
                        'books' => Yaml::encode($books),
                    ],
                ];

                $count++;
            }
        }

        return Pages::factory($children, $this);
    }
}
