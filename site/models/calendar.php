<?php

class CalendarPage extends Page {
    public function subpages()
    {
        return Pages::factory($this->inventory()['children'], $this);
    }


    public function children()
    {
        return parent::children()->add(Pages::factory([
            [
                'slug'     => 'vergangene-veranstaltungen',
                'template' => 'calendar.archive',
                'model' => 'calendar.archive',
                'parent'   => page('kalender'),
                'translations' => [
                    'de' => [
                        'code' => 'de',
                        'content' => [
                            'title' => 'Vergangene Veranstaltungen',
                            'text'  => page('kalender')->archive()->value(),
                            'meta_title' => '',
                            'meta_description' => '',
                            'meta_image' => '',
                            'og_title' => '',
                            'og_description' => '',
                            'og_image' => '',
                            'og_type' => 'website',
                            'twitter_title' => '',
                            'twitter_description' => '',
                            'twitter_image' => '',
                            'twitter_card_type' => 'summary_large_image',
                        ],
                    ],
                    'en' => [
                        'slug' => 'previous-events',
                        'code' => 'en',
                        'content' => [
                            'title' => 'Previous events',
                            'text' => page('kalender')->content('en')->archive()->value(),
                            'metaTitle' => '',
                            'metaDescription' => '',
                            'metaImage' => '',
                            'meta_title' => '',
                            'meta_description' => '',
                            'meta_image' => '',
                            'og_title' => '',
                            'og_description' => '',
                            'og_image' => '',
                            'og_type' => 'website',
                            'twitter_title' => '',
                            'twitter_description' => '',
                            'twitter_image' => '',
                            'twitter_card_type' => 'summary_large_image',
                        ],
                    ],
                    'fr' => [
                        'slug' => 'evenements-precedents',
                        'code' => 'fr',
                        'content' => [
                            'title' => 'Événements précédents',
                            'text' => page('kalender')->content('fr')->archive()->value(),
                            'meta_title' => '',
                            'meta_description' => '',
                            'meta_image' => '',
                            'og_title' => '',
                            'og_description' => '',
                            'og_image' => '',
                            'og_type' => 'website',
                            'twitter_title' => '',
                            'twitter_description' => '',
                            'twitter_image' => '',
                            'twitter_card_type' => 'summary_large_image',
                        ],
                    ],
                ],
            ],
        ], $this));
    }
}
