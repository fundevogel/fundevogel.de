<?php

class CalendarEventPage extends Page {
    /**
     * Builds URL of iCal / `ics` calendar file for single event
     */
    public function ical(): string
    {
        return page('kalender')->url() . '/' . $this->slug() . '.ics';
    }
}
