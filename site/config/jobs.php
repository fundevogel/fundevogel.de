<?php

use PHPCBIS\PHPCBIS;

function pcbis()
{
    // Initializing PHPCBIS object
    $login = file_get_contents(kirby()->root('config') . '/knv.json');
    $login = json_decode($login, true);
    return new PHPCBIS($login);
}

return [
    'loadBook' => function ($page) {
        // API call
        $isbn = $page->isbn()->value();
        $object = pcbis();
        $object->setCachePath(kirby()->root('cache') . '/books');

        $dataRaw = $object->loadBook($isbn);

        // If API call was unsuccessful ..
        if ($dataRaw == false) {
            return [
                'status' => 404,
                'label' => 'Mistikus totalus!',
            ];
        }

        $data = $object->processData($dataRaw);

        $fileName = $page->slug() . '_' . str::slug($data['AutorIn']);

        $dataArray = [
            'autor' => $data['AutorIn'],
            'titel' => $data['Titel'],
            'untertitel' => $data['Untertitel'],
            'participants' => $data['Mitwirkende'],
            'verlag' => $data['Verlag'],
            'alter' => $data['Altersempfehlung'],
            'preis' => $data['Preis'],
            'categories' => $data['Kategorien'],
            'tags' => $data['Schlagworte'],
            'binding' => $data['Einband'],
        ];

        $updateArray = [];

        foreach ($dataArray as $key => $value) {
            if ($page->$key()->isNotEmpty()) {
                continue;
            }

            $updateArray = a::update($updateArray, [
                $key => $value
            ]);
        }

        $page->update($updateArray);

        return [
            'status' => 200,
            'label' => 'Update erfolgreich!',
            'reload' => true,
        ];
    },
    'downloadCover' => function ($page) {
        $isbn = $page->isbn()->value();
        $object = pcbis();
        $imagePath = kirby()->root('content') . '/' . $page->diruri();
        $fileName = $page->slug() . '_' . str::slug($page->autor());

        if (!file_exists($imagePath . '/' . $fileName . '.jpg')) {
            // API call
            $object->setImagePath($imagePath);
            $object->downloadCover($isbn, $fileName, true);

            return [
                'status' => 200,
                'label' => 'Download erfolgreich!',
            ];
        }

        try {
            $page->image($fileName . '.jpg')->update([
                'titleAttribute' => '"' . $page->titel() . '" von ' . $page->autor(),
                'source' => 'Deutsche Nationalbibliothek',
                'altAttribute' => 'Cover des Buches "' . $page->titel() . '" von ' . $page->autor(),
                'template' => 'image',
            ]);
            $page->update([
                'cover' => $fileName . '.jpg',
            ]);
        } catch (Exception $e) {
            return [
                'status' => 404,
                'label' => 'Mistikus totalus!',
            ];
        }

        return [
            'status' => 200,
            'label' => 'Update erfolgreich!',
            'reload' => true,
        ];
    },
    'createMetadata' => function ($page) {
        $files = $page->documents();

        foreach ($files as $file) {
            $fileName = basename($file);

            preg_match('/[0-9]{4}/', $fileName, $year);
            $season = str::contains($fileName, 'fruehjahr') ? 'Frühjahr' : 'Herbst';

            $file->update([
                'titleAttribute' => 'Unsere Empfehlungen im ' . $season,
                'edition' => $season,
                'year' => $year[0],
                'altAttribute' => 'Coverbild unserer ' . $season . 'sempfehlungen',
                'template' => 'pdf',
            ]);
        }

        return [
            'status' => 200,
            'label' => 'Erfolgreich!',
            'reload' => true,
        ];
    },
    'archiveEvents' => function ($page) {
        $oldEvents = page('kalender')->children()->listed()->filter(function ($child) {
            if ($child->multiple_days()->toBool() === true) {
                return $child->end_date()->toDate() < time();
            }

            return $child->date()->toDate() < time();
        });

        foreach ($oldEvents as $child) {
            Dir::move($child->root(), page('vergangene-veranstaltungen')->root() . '/' . $child->dirname());
        }

        return [
            'status' => 200,
            'label' => 'Erfolgreich!',
            'reload' => true,
        ];
    }
];
