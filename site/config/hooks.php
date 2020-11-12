<?php

##
# HOOKS
##

return [
    'kirbytext:after' => function ($text) {
        // See https://forum.getkirby.com/t/add-classes-to-textarea-field-output/14060/5
        $from = [];
        $from[0] = '/<p>/';
        $from[1] = '/<ul>/';
        $from[2] = '/<ol>/';

        $to = [];
        $to[0] = '<p class="content">';
        $to[1] = '<ul class="list">';
        $to[2] = '<ol class="list">';

        return preg_replace($from, $to, $text);
    },
    'page.create:after' => function ($page) {
        if ($page->intendedTemplate() == 'book') {
            $page->changeStatus('listed');

            janitor('downloadCover', $page, $page->id());
            janitor('downloadCover', $page, $page->id());
        }
    }
];
