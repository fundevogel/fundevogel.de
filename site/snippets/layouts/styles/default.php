<?php

# Separate single-column from multi-column designs
if ($layout->columns()->first()->width() != '1/1') {
    snippet('layouts/columns/multiple', compact('layout'));
} else {
    snippet('layouts/columns/single', compact('layout'));
}
