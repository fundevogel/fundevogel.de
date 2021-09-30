<?php

class CalendarEventPage extends Page {
    /**
     *
     */
    public function files()
    {
        return parent::files()->add(new CalendarFile($this));
    }


    /**
     *
     */
    public function ical(): \Kirby\Cms\File
    {
        return $this->files()->filterBy('template', 'calendar')->first();
    }
}
