<?php

class LesetippsVolumePage extends Page {
    public function subpages()
    {
        return Pages::factory($this->inventory()['children'], $this);
    }


    public function children()
    {
        $children = [];

        foreach ($this->files()->filterBy('template', 'pdf') as $edition) {
            $children[] = [
                'slug'     => Str::slug($edition->edition()->value()),
                'template' => 'lesetipps.edition',
                'model'    => 'lesetipps.edition',
                'files'    => (new Files())->add($edition)->toArray(),
                'content'  => [
                    'title' => $edition->edition()->value() . ' ' . $edition->year()->value(),
                    'edition' => $edition->edition()->value(),
                    'year' => $edition->year()->value(),
                ],
            ];
        }

        return Pages::factory($children, $this);
    }
}
