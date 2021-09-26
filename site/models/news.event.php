<?php

class NewsEventPage extends Page {
    public function getImages() {
        return $this->images()->filterBy('extension', 'not in', ['avif', 'webp']);
    }
}
