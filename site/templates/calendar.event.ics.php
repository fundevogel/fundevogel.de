<?php
    # Set headers
    header('Content-type: text/calendar; charset=utf-8');
    header('Content-Disposition: inline; filename=' . $page->slug() . '.ics');

    echo $page->file('calendar.ics')->read();
