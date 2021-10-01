<?php

use Kirby\Cms\File;

use Jsvrcek\ICS\Model\Calendar;
use Jsvrcek\ICS\Model\CalendarEvent;
use Jsvrcek\ICS\Model\Description\Location;

use Jsvrcek\ICS\Utility\Formatter;
use Jsvrcek\ICS\CalendarStream;
use Jsvrcek\ICS\CalendarExport;


class CalendarFile extends File {
    /**
     * Start of event
     *
     * @var \DateTime
     */
    private $eventStart = null;


    /**
     * End of event
     *
     * @var \DateTime
     */
    private $eventEnd = null;


    /**
     * Name of event
     *
     * @var string
     */
    private $eventName = null;


    /**
     * Whether event takes a whole day
     *
     * @var bool
     */
    private $wholeDay = false;


    /**
     * Location of event
     *
     * @var string
     */
    private $eventLocation = null;


    /**
     * Timezone
     *
     * @var \DateTimeZone
     */
    private $timezone = null;


    /**
     * Constructor
     *
     * @param \Kirby\Cms\Page $page
     *
     * @return void
     */
    public function __construct(\Kirby\Cms\Page $page)
    {
        $this->eventStart = new DateTime($page->date(), $this->timezone);

        if ($page->dateEnd()->isEmpty()) {
            $this->eventEnd = clone $this->eventStart;
            $this->eventEnd->setTime(23, 59, 59);

            if ($this->eventStart->format('H:i:s') === '00:00:00') {
                $this->wholeDay = true;
            }
        }

        else {
            $this->eventEnd = new DateTime($page->dateEnd(), $this->timezone);
        }

        $this->eventName = $page->title();
        $this->eventLocation = $page->location();
        $this->timezone = new DateTimeZone('Europe/Berlin');

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
        # Location
        $location = new Location();
        $location->setName($this->eventLocation);

        $event = new CalendarEvent();

        $event
            ->setStart($this->eventStart)
            ->setEnd($this->eventEnd)
            ->setAllDay($this->wholeDay)
            ->setSummary($this->eventName)
            ->addLocation($location);

        $calendar = new Calendar();
        $calendar
            ->setProdId('fundevogel')
            ->setTimezone($this->timezone)
            ->addEvent($event);

        $calendarExport = new CalendarExport(new CalendarStream, new Formatter());
        $calendarExport->addCalendar($calendar);

        return $calendarExport->getStream();
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
