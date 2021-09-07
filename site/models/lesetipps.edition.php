<?php

class LesetippsEditionPage extends Page {
    public function pdf()
    {
        return $this->parent()->file($this->file()->filename());
    }


    public function getFront(string $classes = '')
    {
        return $this->pdf()->getFront($classes);
    }
}
