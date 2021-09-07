<?php

class LesetippsEditionPage extends Page {
    public function pdf()
    {
        return $this->parent()->file($this->file()->filename());
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

        if ($file = $this->parent()->file(Str::slug($this->edition()) . '.json')) {
            $data = Json::read($file->root());

            $count = 1;

            foreach ($data as $chapter => $books) {
                $data = [];

                foreach ($books as $book) {
                    # Add book data
                    $data[] = [
                        'title' => $book['header'][1] ?? $book['header'][0],
                        'author' => $book['header'][0],
                        'isbn' => $book['isbn'],
                        'body' => $book['body'],
                    ];
                }

                # Add chapter as child
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
