<?php

class LesetippsArticlePage extends Page {
    public function getBookCover(string $classes = '') {
        $book = $this->books()->toPages()->first();

        return $book->getBookCover($classes);
    }

    public function getAward() {
        $book = $this->books()->toPages()->first();

        return $book->getAward();
    }
}
