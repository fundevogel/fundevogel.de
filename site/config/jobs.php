<?php

return [
    'upgradeBook' => function ($page, $data) {
        if ($page === null) {
            $page = site()->index(true)->findByID($data);
        }

        try {
            $success = $page->upgradeBook();
            $page->updateOla();
        } catch (Exception $e) {
            return [
                'status' => 404,
                'label'  => $e->getMessage(),
                'reload' => false,
            ];
        }

        return [
            'status' => $success ? 200 : 404,
            'label'  => $success ? 'Upgrade erfolgreich!' : 'Upgrade fehlgeschlagen!',
            'reload' => $success,
        ];
    },
    'ola' => function ($page, $data) {
        if ($page === null) {
            $page = site()->index(true)->findByID($data);
        }

        # Update page
        $success = (bool) $page->updateOla();

        return [
            'status' => $success ? 200 : 404,
            'label'  => $success ? 'Update erfolgreich!' : 'Update fehlgeschlagen!',
            'reload' => $success,
        ];
    },
    'loadBook' => function ($page, $data) {
        if ($page === null) {
            $page = site()->index(true)->findByID($data);
        }

        # Update page
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
            'filename' => Str::slug($page->title()) . '_' . Str::slug($page->author()) . '.jpg',
        ]);

        $book = $page->toBook();

        if (!$file->exists()) {
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
                'label' => $e->getMessage(),
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
    'fetchLanguages' => function ($page)
    {
        # Define request parameters
        $parameters = [
            'timeout' => 0,
            'headers' => [
                'User-Agent' => 'S1SYPHOS @fundevogel.de'
            ],
        ];

        # Fetch languages data from GitHub API
        $langDataURL = 'https://api.github.com/repos/fundevogel/fundevogel.de/languages';
        $langDataResponse = Remote::get($langDataURL, $parameters);

        # If everything goes well, process results ..
        if ($langDataResponse->http_code() !== 200) {
            return [
                'status' => 404,
                'label' => 'Mistikus totalus!',
                'reload' => false,
            ];
        }

        $langData = get_object_vars($langDataResponse->json(false));

        # Add all programming languages detected by GitHub's `linguist`
        #
        # For unaccounted languages, we could loop over those (eg, `yaml`)
        # and get their values too, like this:
        # 'https://api.github.com/search/code?q=language:' . $language . '+repo:fundevogel.de/fundevogel+org:Fundevogel'
        #
        # See https://stackoverflow.com/a/26881503

        $languages = array_keys($langData);
        $numbers = array_values($langData);

        $total = array_sum($numbers);

        $percentages = [];

        foreach ($numbers as $number) {
            $percentage = ($number * 100) / $total;
            $percentages[] = $percentage;
        }

        # Round percentages safely, using `largest remainder method`
        # See https://en.wikipedia.org/wiki/Largest_remainder_method
        $largestRemainder = new Aeq\LargestRemainder\Math\LargestRemainder($percentages);
        // $largestRemainder->setPrecision(2);

        $roundedPercentages = [];

        foreach ($largestRemainder->round() as $number) {
            $roundedPercentages[] = $number / 100;
        }

        # Fetch GitHub's language colors
        $colorData = json_decode(F::read(kirby()->root('config') . '/colors.json'), true);

        # Build languages array
        $data = [];

        foreach (array_combine($languages, $roundedPercentages) as $language => $percentage) {
            $data[$language] = [
                'value' => $percentage,
                'color' => $colorData[$language],
            ];
        }

        # Generate chart from language data
        $page->toDonut($data, 'programmiersprachen', 15, null, 'w-56 h-56 block');

        $file = $page->image('programmiersprachen.svg');

        try {
            $file->update([
                'titleAttribute' => 'Mehr als nur HTML - die Webseite des Fundevogels',
                'altAttribute' => 'Abbildung verwendeter Programmiersprachen als Ringdiagramm',
            ]);

            $languageArray = [];

            foreach ($data as $language => $values) {
                $languageArray[] = ['title' => $language, 'share' => $values['value'], 'color' => $values['color']];
            }

            $page->update([
                'languages' => Data::encode($languageArray, 'yaml'),
                'chart' => Data::encode($file->filename(), 'yaml'),
            ]);

        } catch(Exception $e) {
            return [
                'status' => 404,
                'label' => $e->getMessage(),
                'reload' => false,
            ];
        }

        return [
            'status' => 200,
            'label' => 'Update erfolgreich!',
            'reload' => true,
        ];
    },
    'clearDejure' => function ()
    {
        $success = clearDJO();

        return [
            'status' => $success ? 200 : 404,
            'label'  => $success ? 'Cache geleert!' : 'Cache nicht geleert!',
            'reload' => $success,
        ];
    },
];
