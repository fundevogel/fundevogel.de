<?php

class CalendarSinglePage extends Page {
    public function getPreview() {
        $image = $this->previewImage()->isNotEmpty()
            ? $this->previewImage()->toFile()
            : $this->getCover()
        ;

        return $image->createImage('rounded-full transition-transform duration-350 transform group-hover:scale-110', 'calendar.single.preview', false, true);
    }
}
