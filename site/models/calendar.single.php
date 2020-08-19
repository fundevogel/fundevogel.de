<?php

class CalendarSinglePage extends Page {
    public function getPreview() {
        $image = $this->previewImage()->isNotEmpty()
            ? $this->previewImage()->toFile()
            : $this->getCover()
        ;

        return $image->createImage('inline-block rounded-full', 'calendar.single.preview');
    }
}
