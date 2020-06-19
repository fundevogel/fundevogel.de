<?php

use Uniform\Form;

return function ($kirby) {
    $form = new Form([
        'Name' => [],
        'Adresse' => [],
        'KundeSeit' => [],
        'InteresseKJL' => [],
        'BesonderheitenFV' => [],
        'AngebotErweitern' => [],
        'AngebotErweiternWie' => [],
        'SortimentBeratungZufrieden' => [],
        'SortimentBeratungWas' => [],
        'ServiceSchnelligkeitZufrieden' => [],
        'ServiceSchnelligkeitWas' => [],
        'OeffnungszeitenWerktag' => [],
        'OeffnungszeitenSamstag' => [],
        'BeitrittGenoVorstellbar' => [],
        'HoeheAnteile' => [],
        'HoeheAnteileAlternativ' => [],
        'MithilfeVorstellbar' => [],
        'MithilfeWas' => [],
    ]);

    if ($kirby->request()->is('POST')) {
        $form->logAction([
            'file' => $kirby->roots()->site() . '/geno-umfrage.log',
        ]);
    }

    return compact('form');
};
