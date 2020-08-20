<?php

class CalendarSinglePage extends Page {
    public function getPreview() {
        $image = $this->previewImage()->isNotEmpty()
            ? $this->previewImage()->toFile()
            : $this->getCover()
        ;

        return $image->createImage('rounded-full', 'calendar.single.preview');
    }
}
