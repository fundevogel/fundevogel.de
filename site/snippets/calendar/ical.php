BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//<?= site()->url() ?>//Fundevogel//<?= str::upper(site()->language()->code()) . "\n" ?>
METHOD:PUBLISH
BEGIN:VEVENT
DTSTART:<?= gmdate('Ymd\THis\Z', strtotime($event->date() . ' ' . $event->begin_time())) . "\n" ?>
DTEND:<?= gmdate('Ymd\THis\Z', strtotime($event->end_date() . ' ' . $event->end_time())) . "\n" ?>
SUMMARY:<?= $event->title() . "\n" ?>
DESCRIPTION:<?= $event->text() . "\n" ?>
LOCATION:<?= $event->location() . "\n" ?>
ORGANIZER;CN="<?= site()->title() ?>":MAILTO:<?= site()->mail() . "\n" ?>
END:VEVENT
END:VCALENDAR
