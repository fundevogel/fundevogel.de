<?php

return [
    'loadBook' => function ($page, $data) {
        if ($page === null) {
            $page = site()->index(true)->findByID($data);
        }

        # API call
        $isbn = $page->isbn()->value();
        $data = loadBook($isbn);

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
            'shop' => rtrim(getShopLink($isbn), '01234567890/'),
        ];

        $page->updateBook($dataArray);

        return [
            'status' => 200,
            'label' => 'Update erfolgreich!',
            'reload' => true,
        ];
    },
    'downloadCover' => function ($page, $data) {
        if ($page === null) {
            $page = site()->index(true)->findByID($data);
        }

        $imagePath = kirby()->root('content') . '/' . $page->diruri();
        $fileName = implode('_', [Str::slug($page->book_title()), Str::slug($page->author())]);

        if (!file_exists($imagePath . '/' . $fileName . '.jpg')) {
            # API call
            $object = pcbis();
            $object->setImagePath($imagePath);
            $isbn = $page->isbn()->value();
            $download = $object->downloadCover($isbn, $fileName, true);

            return [
                'status' => $download ? 200 : 404,
                'label' => $download ? 'Download erfolgreich!' : 'Download fehlgeschlagen',
                'reload' => $download ? true : false,
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
    'assortment.fetchData' => function ($page) {
        $favorites = $page->favorites()->yaml();
        $object = pcbis();
        $object->setCachePath(kirby()->root('cache') . '/books');

        $count = 0;

        foreach ($favorites as &$favorite) {
            $isbn = $favorite['isbn'];

            try {
                $data = loadBook($isbn);

                $dataArray = [
                    'book_title' => 'Titel',
                    'book_subtitle' => 'Untertitel',
                    'text' => 'Inhaltsbeschreibung',
                    'author' => 'AutorIn',
                    'participants' => 'Mitwirkende',
                    'publisher' => 'Verlag',
                    'age' => 'Altersempfehlung',
                    'page_count' => 'Seitenzahl',
                    'price' => 'Preis',
                    'binding' => 'Einband',
                ];

                # Only edit these if empty to prevent data loss
                foreach ($dataArray as $field => $content) {
                    # If two out of three fields are filled, and one of them is `author`,
                    # don't fill `participants` again, as we did it before already
                    if ($field === 'participants') {
                        if (($favorite['author'] !== '' && $favorite['illustrator'] !== '') || ($favorite['author'] !== '' && $favorite['translator'] !== '')) {
                            continue;
                        }
                    }

                    if ($favorite[$field] === '') {
                        $favorite[$field] = $data[$content];
                    }
                }
            } catch (\Exception $e) {
                continue;
            }

            $count++;
        }

        $success = true;

        try {
            $page->update([
                'favorites' => yaml::encode($favorites)
            ]);
        } catch (Exception $e) {
            $success = false;
        }

        return [
            'status' => $success ? 200 : 404,
            'label' => $success ? 'Erfolgreich!' : 'Mistikus totalus!',
            'reload' => $success,
        ];
    },
    'assortment.downloadCover' => function ($page) {
        $favorites = $page->favorites()->yaml();
        $object = pcbis();
        $imagePath = $page->root();
        $object->setImagePath($imagePath);

        foreach ($favorites as &$favorite) {
            $isbn = $favorite['isbn'];

            $fileName = implode('_', [Str::slug($favorite['book_title']), Str::slug($favorite['author'])]);
            $favorite['book_cover'] = $fileName . '.jpg';

            if (!file_exists(implode('/', [$imagePath, $fileName . '.jpg']))) {
                $object->downloadCover($isbn, $fileName, true);
            } else {
                $page->image($fileName . '.jpg')->update([
                    'titleAttribute' => '"' . $favorite['book_title'] . '" von ' . $favorite['author'],
                    'source' => 'Deutsche Nationalbibliothek',
                    'altAttribute' => 'Cover des Buches "' . $favorite['book_title'] . '" von ' . $favorite['author'],
                    'template' => 'image',
                ]);
            }
        }

        $success = true;

        try {
            $page->update([
                'favorites' => yaml::encode($favorites)
            ]);
        } catch (Exception $e) {
            $success = false;
        }

        return [
            'status' => $success ? 200 : 404,
            'label' => $success ? 'Erfolgreich!' : 'Mistikus totalus!',
            'reload' => $success,
        ];
    },
    'builder.downloadCover' => function ($page) {
        $builder = $page->builder()->yaml();
        $object = pcbis();
        $imagePath = $page->root();
        $object->setImagePath($imagePath);

        $books = [];

        # Collect book data
        foreach ($builder as $block) {
            if (A::missing($block, ['books'])) {
                continue;
            }

            $entries = $block['books'];

            foreach ($entries as $entry) {
                $books[] = [
                    'isbn' => $entry['isbn'],
                    'author' => $entry['author'],
                    'book_title' => $entry['book_title'],
                ];
            }
        }

        # Download covers & update images
        foreach ($books as $book) {
            $isbn = $book['isbn'];
            $fileName = implode('_', [Str::slug($book['book_title']), Str::slug($book['author'])]);

            if (!file_exists(implode('/', [$imagePath, $fileName . '.jpg']))) {
                $object->downloadCover($isbn, $fileName, true);
            } else {
                try {
                    $page->image($fileName . '.jpg')->update([
                        'titleAttribute' => '"' . $book['book_title'] . '" von ' . $book['author'],
                        'source' => 'Deutsche Nationalbibliothek',
                        'altAttribute' => 'Cover des Buches "' . $book['book_title'] . '" von ' . $book['author'],
                        'template' => 'image',
                    ]);
                } catch (Exception $e) {
                    continue;
                }
            }
        }

        return [
            'status' => 200,
            'label' => 'Update erfolgreich!',
            'reload' => true,
        ];
    }
];
