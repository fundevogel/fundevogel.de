<?php

class LesetippsArchivePage extends Page {
    public function subpages()
    {
        return Pages::factory($this->inventory()['children'], $this);
    }


    public function children()
    {
        $children = [];

        foreach (parent::children()->filterBy('intendedTemplate', 'lesetipps.volume') as $volume) {
            foreach ($volume->files()->filterBy('template', 'pdf') as $edition) {
                $title = $edition->edition()->value() . ' ' . $edition->year()->value();

                $children[] = [
                    'slug'     => Str::slug($title),
                    'template' => 'lesetipps.edition',
                    'model'    => 'lesetipps.edition',
                    'content'  => [
                        'title'   => $title,
                        'edition' => $edition->edition()->value(),
                        'year'    => $edition->year()->value(),
                    ],
                ];
            }
        }

        return parent::children()->add(Pages::factory($children, $this));
    }
}
