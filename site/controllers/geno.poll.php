<?php

use Uniform\Form;

return function ($kirby, $page) {
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
        'WeitereAnregungen' => [],
        'Kontakt' => [],
    ]);

    if ($kirby->request()->is('POST')) {
        $form->logAction([
            'file' => $kirby->roots()->site() . '/geno-umfrage.log',
        ]);
    }

    $file = $page->files()
                 ->filterBy('extension', 'pdf')
                 ->first();

    return compact(
        'form',
        'file',
    );
};
