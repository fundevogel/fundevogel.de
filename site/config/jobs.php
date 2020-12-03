<?php

return [
    'loadBook' => function ($page, $data) {
        if ($page === null) {
            $page = site()->index(true)->findByID($data);
        }

        $success = $page->updateBook();

        return [
            'status' => $success ? 200 : 404,
            'label'  => $success ? 'Update erfolgreich!' : 'Update fehlgeschlagen!',
            'reload' => $success,
        ];
    },
    'downloadCover' => function ($page, $data) {
        if ($page === null) {
            $page = site()->index(true)->findByID($data);
        }

        $file = new File([
            'parent' => $page,
            'filename' => Str::slug($page->book_title()) . '_' . Str::slug($page->author()) . '.jpg',
        ]);

        if (!$file->exists()) {
            $book = $page->toBook();
            $book->setImagePath($page->root());
            $download = $book->downloadCover($file->name(), true);
        }

        try {
            $file->update([
                'titleAttribute' => '"' . $book->title() . '" von ' . $book->author(),
                'source' => 'Deutsche Nationalbibliothek',
                'altAttribute' => 'Cover des Buches "' . $book->title() . '" von ' . $book->author(),
                'template' => 'image',
            ]);

            $page->update([
                'cover' => Data::encode($file->filename(), 'yaml'),
            ]);
        } catch (Exception $e) {
            return [
                'status' => 404,
                'label' => $e,
                'reload' => false,
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
        $oldEvents = page('kalender')->children()->listed()->filterBy('intendedTemplate', 'calendar.event')->filter(function ($child) {
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
    },
];
