<?php
    # iCalendar base template

    if ($iCal = $page->file('calendar.ics')) {
        # Set headers
        header('Content-type: text/calendar; charset=utf-8');
        header('Content-Disposition: inline; filename=' . $page->slug());

        echo $iCal->read();
    }
