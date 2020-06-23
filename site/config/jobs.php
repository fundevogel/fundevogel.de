<?php

return [
    'loadBook' => function ($page) {
        # API call
        $isbn = $page->isbn()->value();
        $object = pcbis();
        $object->setCachePath(kirby()->root('cache') . '/books');

        $dataRaw = $object->loadBook($isbn);

        # If API call was unsuccessful ..
        if ($dataRaw == false) {
            return [
                'status' => 404,
                'label' => 'Mistikus totalus!',
            ];
        }

        $data = $object->processData($dataRaw);

        $dataArray = [
            'book_title' => $data['Titel'],
            'book_subtitle' => $data['Untertitel'],
            'author' => $data['AutorIn'],
            'participants' => $data['Mitwirkende'],
            'publisher' => $data['Verlag'],
            'age' => $data['Altersempfehlung'],
            'page_count' => $data['Seitenzahl'],
            'price' => $data['Preis'],
            'binding' => $data['Einband'],
            'categories' => $data['Kategorien'],
            'topics' => $data['Schlagworte'],
        ];

        $updateArray = [];

        foreach ($dataArray as $key => $value) {
            if ($page->$key()->isNotEmpty()) {
                continue;
            }

            # If two out of three fields are filled, and one of them is `author`,
            # don't fill `participants` again, as we did it before already
            if ($key === 'participants') {
                if (($page->author()->isNotEmpty() && $page->illustrator()->isNotEmpty()) || ($page->author()->isNotEmpty() && $page->translator()->isNotEmpty())) {
                    continue;
                }
            }

            $updateArray = A::update($updateArray, [
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
        $fileName = $page->slug() . '_' . Str::slug($page->author());

        if (!file_exists($imagePath . '/' . $fileName . '.jpg')) {
            # API call
            $object->setImagePath($imagePath);
            $object->downloadCover($isbn, $fileName, true);

            return [
                'status' => 200,
                'label' => 'Download erfolgreich!',
            ];
        }

        try {
            $page->image($fileName . '.jpg')->update([
                'titleAttribute' => '"' . $page->book_title() . '" von ' . $page->author(),
                'source' => 'Deutsche Nationalbibliothek',
                'altAttribute' => 'Cover des Buches "' . $page->book_title() . '" von ' . $page->author(),
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
    'createMetadata' => function ($page, $data) {
        # Check if PDF file exists
        if ($file = $page->file($data)) {
            # Build data for PDF
            $extension = 'jpg';
            $inputFile = $file->root();
            $outputFile = $file->root() . '.' . $extension;

            # (1) Generate metadata
            $fileName = basename($outputFile);
            preg_match('/[0-9]{4}/', $fileName, $year);
            $season = Str::contains($fileName, 'fruehjahr') ? 'Frühjahr' : 'Herbst';

            $cover = $page->images($fileName);

            # (2) Create thumbnail image ..
            if (!F::exists($outputFile) || (F::modified($outputFile) < $file->modified())) {
                # .. only if it doesn't exist or PDF file changed since its creation
                $im = new Imagick();
                $im->setResolution(300, 300);
                $im->readImage($inputFile . '[0]');
                // $im->setImageBackgroundColor('white');
                $im->setImageAlphaChannel(Imagick::ALPHACHANNEL_REMOVE);
                $im->setImageFormat($extension);
                $im->setImageCompression(Imagick::COMPRESSION_JPEG);
                $im->writeImage($outputFile);
                $im->clear();

                # Update thumbnail image metadata
                $cover = new File([
                    'source' => $outputFile,
                    'filename' => $fileName,
                    'parent' => $file->parent(),
                ]);
            }

            $cover->update([
                'template' => 'image',
                'titleAttribute' => 'Unsere Empfehlungen im ' . $season,
                'altAttribute' => 'Coverbild unserer Empfehlungen im ' . $season,
                'source' => 'Eigenmaterial',
                'caption_wanted' => true,
                'caption' => $season,
            ]);

            $file->update([
                'coverImage' => $fileName,
                'edition' => $season,
                'year' => $year[0],
            ]);
        }

        return [
            'status' => $file ? 200 : 404,
            'label' => $file ? 'Erfolgreich!' : 'Mistikus totalus!',
            'reload' => $file ? true : false,
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
            Dir::move($child->root(), page('kalender/vergangene-veranstaltungen')->root() . '/' . $child->dirname());
        }

        return [
            'status' => 200,
            'label' => 'Erfolgreich!',
            'reload' => true,
        ];
    }
];
