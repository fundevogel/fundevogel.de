<?php

# Define request parameters
$parameters = [
    'timeout' => 0,
    'headers' => ['User-Agent' => 'maschinenraum@fundevogel.de'],
];

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
    'fetchStatistics' => function ($page) use ($parameters)
    {
        $source = [];

        # Fetch statistics
        $toolsetDir = kirby()->root('base') . '/lib/toolset';

        # (1) Lines of code
        exec(sprintf('bash %s/lines_of_code.bash', $toolsetDir), $outputLines);

        if (is_array($outputLines) && count($outputLines) >= 1) {
            $source['loc'] = number_format((string) $outputLines[0], 0, ',', '.');
        }

        # (2) Average commits/month for last three months
        exec(sprintf('bash %s/average_commits_per_month.bash', $toolsetDir), $outputCommits);

        if (is_array($outputCommits) && count($outputCommits) >= 1) {
            $source['commits'] = (string) $outputCommits[0];
        }

        # (3) PageSpeed performance score
        # Fetch data from Google's PageSpeed API
        $pagespeedURL = 'https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url=https://fundevogel.de&category=performance';
        $pagespeedResponse = Remote::get($pagespeedURL, $parameters);

        # If everything goes as planned ..
        if ($pagespeedResponse->http_code() === 200) {
            # .. process response
            $pagespeedData = $pagespeedResponse->json(true);

            # .. and add PageSpeed score
            $source['pagespeed'] = 100 * $pagespeedData['lighthouseResult']['categories']['performance']['score'];
        }

        # (4) Observatory security grade
        # Fetch data from Mozilla's Observatory API
        $observatoryURL = 'https://http-observatory.security.mozilla.org/api/v1/analyze?host=fundevogel.de&rescan=true';
        $observatoryResponse = Remote::get($observatoryURL, $parameters);

        # If everything goes as planned ..
        if ($observatoryResponse->http_code() === 200) {
            # .. process response
            $observatoryData = $observatoryResponse->json(true);

            # .. ensure test validity
            if (!isset($observatoryData['error'])) {
                # .. and add Observatory grade
                $source['observatory'] = $observatoryData['grade'];
            }
        }

        # (5) Repository data
        # Fetch data from GitHub GitHub's repository API
        $repoDataURL = 'https://api.github.com/repos/fundevogel/fundevogel.de';
        $repoDataResponse = Remote::get($repoDataURL, $parameters);

        # If everything goes as planned ..
        if ($repoDataResponse->http_code() === 200) {
            # .. process response
            $repoData = $repoDataResponse->json(true);

            # .. and add repository data
            # TODO: Think about `size` and stuff like that
            $source['licenseFull'] = $repoData['license']['name'];
            $source['licenseToken'] = $repoData['license']['spdx_id'];
        }

        # Report back results
        $success = true;
        $message = 'Update erfolgreich!';

        if (empty($source)) {
            $message = 'Nichts zu tun!';

        } else {
            try {
                # Attempt page update
                $page->update($source);

            } catch(Exception $e) {
                # Save error message
                $message = $e->getMessage();
                $success = false;
            }
        }

        return [
            'status' => $success ? 200 : 404,
            'label' => $message,
            'reload' => $success,
        ];
    },
    'fetchLanguages' => function ($page) use ($parameters)
    {
        # Fetch programming languages from GitHub's API as detected by `linguist`
        #
        # For unaccounted languages (eg, `yaml`),
        # see https://stackoverflow.com/a/26881503
        $langDataURL = 'https://api.github.com/repos/fundevogel/fundevogel.de/languages';
        $langDataResponse = Remote::get($langDataURL, $parameters);

        # Toss it if something goes wrong, otherwise ..
        if ($langDataResponse->http_code() !== 200) {
            return [
                'status' => 404,
                'label' => 'Mistikus totalus!',
                'reload' => false,
            ];
        }

        # .. process response
        $langData = get_object_vars($langDataResponse->json(false));

        # Determine language ratios as percentages
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
        $largestRemainder = new \Aeq\LargestRemainder\Math\LargestRemainder($percentages);
        $largestRemainder->setPrecision(1);

        # Fetch GitHub's language colors
        $colorData = json_decode(F::read(kirby()->root('config') . '/colors.json'), true);

        # Build languages array
        $data = [];

        foreach (array_combine($languages, $largestRemainder->round()) as $language => $percentage) {
            $data[$language] = [
                'value' => $percentage,
                'color' => $colorData[$language],
            ];
        }

        # Generate chart from language data
        $graph = new \Goat1000\SVGGraph\SVGGraph(100, 100, [
            # General options
            'structure' => ['key' => 0, 'value' => 1, 'colour' => 2],
            'sort' => false,

            # SVG options
            'svg_class' => 'block w-56 h-56',
            'auto_fit' => true,

            # Graph options
            'start_angle'  => -90,
            'inner_radius' => 0.7,
            'stroke_width' => 0,

            # Background
            'back_stroke_width' => 0,
            'back_colour' => null,

            # Padding
            'pad_bottom' => 0,
            'pad_left'   => 0,
            'pad_right'  => 0,
            'pad_top'    => 0,

            # Remove labels
             'show_labels' => false,

            # Remove JavaScript
            'show_tooltips' => false,
        ]);

        $values = [];

        $count = 0; foreach ($data as $entry) {
            $values[] = [$count, $entry['value'], $entry['color']];
            $count++;
            $values[] = [$count, 0.3, 'none'];
            $count++;
        }

        $graph->values($values);

        $file = new File([
            'parent' => $page,
            'filename' => 'programmiersprachen.svg',
        ]);

        if (!F::write($file->root(), $graph->fetch('DonutGraph', false))) {
            throw new Exception('Couldn\'t create chart!');
        }

        try {
            $file->update([
                'titleAttribute' => 'Mehr als nur HTML - die Webseite des Fundevogels',
                'altAttribute' => 'Abbildung verwendeter Programmiersprachen als Ringdiagramm',
                'template' => 'image',
            ]);

            $languageArray = [];

            foreach ($data as $language => $values) {
                $languageArray[] = [
                    'title' => $language,
                    'share' => (float) $values['value'],
                    'color' => $values['color']
                ];
            }

            $page->update([
                'langData' => Data::encode($languageArray, 'yaml'),
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
    'fetchPackages' => function ($page)
    {
        # Define cache settings
        $cacheConfig = ['storage' => kirby()->root('cache') . '/php-thx'];
        $cacheDuration = 14 * 24 * 60 * 60;  # two weeks

        # Fetch information about packages being used throughout the website
        # (1) Composer
        $dataFile = kirby()->root('base') . '/composer.json';
        $lockFile = kirby()->root('base') . '/composer.lock';

        $phpDriver = new \S1SYPHOS\Thx($dataFile, $lockFile, 'file', $cacheConfig);

        # Block unwanted libraries
        $phpDriver->setBlockList(['php']);

        # Set cache expiry (two weeks)
        $phpDriver->setCacheDuration($cacheDuration);

        # (2) (Node)JS packages
        $dataFile = kirby()->root('base') . '/package.json';
        $lockFile = kirby()->root('base') . '/yarn.lock';

        $pkgDriver = new \S1SYPHOS\Thx($dataFile, $lockFile, 'file', $cacheConfig);

        # Set cache expiry
        $pkgDriver->setCacheDuration($cacheDuration);

        try {
            # Update package data
            # (1) Process & sort PHP data
            $phpData = $phpDriver->giveBack()->pkgs();

            array_multisort(
                array_column($phpData, 'maintainer'), SORT_ASC,
                array_column($phpData, 'name'), SORT_ASC,
                $phpData
            );

            # (2) Process & sort (Node)JS data
            $pkgData = $pkgDriver->giveBack()->pkgs();

            array_multisort(
                array_column($pkgData, 'maintainer'), SORT_ASC,
                array_column($pkgData, 'name'), SORT_ASC,
                $pkgData
            );

            # (3) Attempt page update
            $page->update([
                'phpData' => Data::encode($phpData, 'yaml'),
                'pkgData' => Data::encode($pkgData, 'yaml'),
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
    'fetchToot' => function ($page, $data)
    {
        if ($page === null) {
            $page = site()->index(true)->findByID($data);
        }

        $success = false;

        if ($id = $page->toot()->value()) {
            # Create API object
            $api = new \Fundevogel\Mastodon\Api('freiburg.social');

            # Assign access token
            $api->accessToken = env('access_token');

            # Fetch toot
            $toot = $api->statuses()->get($id);

            # Update page
            $page->update([
                'tootText' => $toot->content(),
                'tootDate' => $toot->createdAt(),
                'tootLink' => $toot->url(),
            ]);

            # Download images
            foreach ($toot->downloadMedia($page->root()) as $index => $file) {
                # Build path
                $name = basename($file);
                $path = $page->root() . '/' . $name;

                # Update file
                $file = new File([
                    'filename' => basename($path),
                    'parent' => $page,
                ]);

                $file->update([
                    'template' => 'image',
                    'description' => $toot->data['media_attachments'][$index]['description'],
                ]);
            }

            $success = true;
        }

        return [
            'status' => $success ? 200 : 404,
            'label'  => $success ? 'Update erfolgreich!' : 'Mistikus totalus!',
            'reload' => $success,
        ];
    },
];
