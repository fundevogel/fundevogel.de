<?php

class CalendarEventPage extends Page {
    /**
     * @return \Kirby\Cms\Files
     */
    public function files()
    {
        return parent::files()->add(new CalendarFile($this));
    }
}
