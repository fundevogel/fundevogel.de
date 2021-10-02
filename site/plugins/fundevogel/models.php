<?php

use DateTime;
use DateTimeZone;

use Kirby\Cms\File;
use Kirby\Cms\Page;

use Jsvrcek\ICS\Model\Calendar;
use Jsvrcek\ICS\Model\CalendarEvent;
use Jsvrcek\ICS\Model\Description\Location;
use Jsvrcek\ICS\Model\Relationship\Organizer;

use Jsvrcek\ICS\Utility\Formatter;
use Jsvrcek\ICS\CalendarStream;
use Jsvrcek\ICS\CalendarExport;


class iCalPage extends Page {
    /**
     * @return \Kirby\Cms\Files
     */
    public function files()
    {
        return parent::files()->add(new CalendarFile($this));
    }
}


class CalendarFile extends File {
    /**
     * Timezone
     *
     * @var \DateTimeZone
     */
    private $timezone = null;


    /**
     * Event pages
     *
     * @var \Kirby\Cms\Pages
     */
    private $events = null;


    /**
     * Constructor
     *
     * @param \Kirby\Cms\Page $page
     *
     * @return void
     */
    public function __construct(\Kirby\Cms\Page $page)
    {
        # Define timezone
        $this->timezone = new DateTimeZone('Europe/Berlin');

        # Define global events (as fallback)
        $this->events = kirby()->collection('events/all');

        # If event page is being passed ..
        if ($page->intendedTemplate() == 'calendar.event') {
            # .. use it as standalone
            $this->events = new Pages([$page]);
        }

        parent::__construct([
            'filename' => 'calendar.ics',
            'template' => 'calendar',
            'parent'   => $page,
            'url'      => $page->url() . '.ics',
            'content'  => []
        ]);
    }


    /**
     * Deletes the file
     *
     * Note: this needs to exist or deleting the page won't work
     *
     * @return bool
     */
    public function delete(): bool
    {
        return true;
    }


    /**
     * Low level data writer method to store the given data on disk or anywhere else
     *
     * Note: not supported
     *
     * @return bool
     */
    public function writeContent(array $data, string $languageCode = null): bool {}


    /**
     * Reads the file content and returns it
     *
     * @return string
     */
    public function read(): string
    {
        $calendar = (new Calendar())
            ->setProdId('-//Buchhandlung Fundevogel//Kalender//DE')
            ->setTimezone($this->timezone);

        # Event organizer
        $organizer = (new Organizer(new Formatter()))
            ->setValue(site()->mail())
            ->setName('Buchhandlung Fundevogel')
            ->setLanguage('de');

        foreach ($this->events as $event) {
            # Event date & time
            $wholeDay = false;

            $eventStart = new DateTime($event->date(), $this->timezone);

            if ($event->dateEnd()->isEmpty()) {
                $eventEnd = clone $eventStart;
                $eventEnd->setTime(23, 59, 59);

                if ($eventStart->format('H:i:s') === '00:00:00') {
                    $wholeDay = true;
                }
            }

            else {
                $eventEnd = new DateTime($event->dateEnd(), $this->timezone);
            }

            # Event location
            $location = (new Location())
                ->setName($event->location())
                ->setLanguage('de');

            # Event
            $entry = (new CalendarEvent())
                ->setOrganizer($organizer)
                ->setUid($this->parent->uid())
                ->setStart($eventStart)
                ->setEnd($eventEnd)
                ->setAllDay($wholeDay)
                ->setSummary($event->title())
                ->setDescription($event->text())
                ->setUrl($event->link())
                ->addLocation($location);

            $calendar->addEvent($entry);
        }

        return (new CalendarExport(new CalendarStream, new Formatter()))
            ->addCalendar($calendar)
            ->getStream();
    }


    /**
     * Returns the raw size of the file
     *
     * @return int
     */
    public function size(): int
    {
        return strlen($this->read());
    }


    /**
     * Returns the file size in a human-readable format
     *
     * @return string
     */
    public function niceSize(): string
    {
        $size = $this->size();

        # the math magic
        $size = round($size / pow(1024, ($unit = floor(log($size, 1024)))), 2);

        return $size . ' ' . Kirby\Toolkit\F::$units[$unit];
    }
}
