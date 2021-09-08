<?php

class LesetippsEditionChapterPage extends Page {
    public function subpages()
    {
        return Pages::factory($this->inventory()['children'], $this);
    }


    public function children()
    {
        # Grab data page for current edition
        $edition = $this->parent()->data();

        # Determine directories
        $cacheDir = $edition->root() . '/.cache';

        $children = [];

        if ($file = $edition->file('data.json')) {
            $count = 1;

            foreach (Json::read($file->root())[$this->title()->value()] as $book) {
                # Add books as children
                $title = $book['header'][1] ?? $book['header'][0];

                # Prepare content
                $content = [
                    'title'  => $title,
                    'author' => $book['header'][0],
                    'body'   => A::join($book['body'], "\n"),
                    'shop'   => '',
                ];

                try {
                    # Fetch information from API
                    $data = loadBook($book['isbn'], $cacheDir);

                    # Update content
                    $content = A::merge($data, $content);

                    # Add shop link
                    $content['shop'] = getShopLink($book['isbn']);

                } catch(Exception $e) {}

                try {
                    # Update availability
                    $content['isAvailable'] = pcbis($cacheDir)->ola($book['isbn'])->isAvailable();

                } catch(Exception $e) {}

                $children[] = [
                    'slug'     => Str::slug($title),
                    'num'      => $count,
                    'template' => 'lesetipps.edition.book',
                    'model'    => 'lesetipps.edition.book',
                    'content'  => $content,
                ];

                $count++;
            }
        }

        return Pages::factory($children, $this);
    }
}
