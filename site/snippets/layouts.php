<?php

foreach ($layouts as $layout) {
    snippet('layouts/styles/' . $layout->style()->value(), compact('layout'));
}
