<?php
    # Set headers
    header('Content-Type: text/calendar; charset=utf-8');
    header('Content-Disposition: attachment; filename="' . $title . '.ics"');

    echo $page->ics()->read();
?>
