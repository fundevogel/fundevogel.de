<?php

class LesetippsArticlePage extends Page {
    public function getAward() {
        $award = '';

        if (Str::contains(Str::slug($this->award()), 'lesepeter')) {
            $award = 'lesepeter';
        }

        if (Str::contains(Str::slug($this->award()), 'wolgast')) {
            $award = 'wolgast';
        }

        if ($award === '') {
            return [];
        }

        $array = site()->awards()
                       ->toStructure()
                       ->filterBy('identifier', $award)
                       ->first()
                       ->toArray();

        $array['awardlink'] = $this->leselink()->toUrl();
        $array['awardtitle'] = $this->award()->value() . ' ' . $this->awardEdition()->value();

        return $array;
    }
}
