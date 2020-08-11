<?php

use Aeq\LargestRemainder\Math\LargestRemainder;

# TODO: Add 'forked' status, eg `bigpicture
# TODO: Add card layout`

return function ($kirby, $page) {
    # Initialize dependency cache
    $depsCache = $kirby->cache('deps');

    # Define request parameters
    $parameters = [
        'timeout' => 0,
        'headers' => [
            'User-Agent' => 'S1SYPHOS @fundevogel.de'
        ],
    ];

    # Fetch cached repository data
    $repoData  = $depsCache->get('repoData');

    # If not cached ..
    if ($repoData === null) {
        # .. fetch information from GitHub (repository)
        $repoDataURL = 'https://api.github.com/repos/fundevogel/fundevogel.de';
        $repoDataResponse = Remote::get($repoDataURL, $parameters);

        # If everything goes well, process results ..
        if ($repoDataResponse->http_code() === 200) {
            $repoData = $repoDataResponse->json(true);

            # .. and cache data for one week (60 * 24 * 7)
            $depsCache->set('repoData', $repoData, 10080);

        }
    }

    # Create repository data
    $source = [
        'desc' => $repoData['description'],
        'url' => $repoData['html_url'],
        'size' => $repoData['size'],
        'loc' => '',
        'activity' => '',
        'languages' => [],
        'license' => [
            'short' => $repoData['license']['spdx_id'],
            'long' => $repoData['license']['name'],
        ],
        'pagespeed' => '',
        'observatory' => [
            'score' => '',
            'grade' => '',
        ],
    ];


    # Fetch cached languages data
    $langData  = $depsCache->get('langData');

    # If not cached ..
    if ($langData === null) {
        # .. fetch information from GitHub (languages)
        $langDataURL = 'https://api.github.com/repos/fundevogel/fundevogel.de/languages';
        $langDataResponse = Remote::get($langDataURL, $parameters);

        # If everything goes well, process results ..
        if ($langDataResponse->http_code() === 200) {
            $langData = get_object_vars($langDataResponse->json(false));

            # .. and cache data for one week (60 * 24 * 7)
            $depsCache->set('langData', $langData, 10080);
        }
    }

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
    $largestRemainder = new LargestRemainder($percentages);
    // $largestRemainder->setPrecision(1);

    $roundedPercentages = [];

    foreach ($largestRemainder->round() as $number) {
        $roundedPercentages[] = $number / 100;
    }

    # Fetch GitHub's language colors
    $path = $kirby->root('config');
    $file = $path . '/colors.json';

    // if (!file_exists($file)) {
    //     exec('cd ' . $kirby->root('base') . ' && source .env/bin/activate && python toolset/github_colors.py ' . $path);
    // }

    $colorData = json_decode(file_get_contents($file), true);

    # Build languages array
    foreach (array_combine($languages, $roundedPercentages) as $language => $percentage) {
        $source['languages'][$language] = [
            'value' => $percentage,
            'color' => $colorData[$language],
        ];
    }


    # Fetch cached PageSpeed performance score
    $pagespeedData  = $depsCache->get('pagespeed');

    # If not cached ..
    if ($pagespeedData === null) {
        # .. fetch them
        $pagespeedURL = 'https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url=https://fundevogel.de&category=performance';
        $pagespeedResponse = Remote::get($pagespeedURL, $parameters);

        # If everything goes well, process results ..
        if ($pagespeedResponse->http_code() === 200) {
            $pagespeedData = $pagespeedResponse->json(true);

            # .. and cache data for one week (60 * 24 * 7)
            $depsCache->set('pagespeed', $pagespeedData, 10080);
        }
    }

    # Add PageSpeed score
    $source['pagespeed'] = 100 * $pagespeedData['lighthouseResult']['categories']['performance']['score'];


    # Fetch cached Observatory security score
    $observatoryData  = $depsCache->get('observatory');

    # If not cached ..
    if ($observatoryData === null) {
        # .. fetch them
        $observatoryURL = 'https://http-observatory.security.mozilla.org/api/v1/analyze?host=fundevogel.de&rescan=true';
        $observatoryResponse = Remote::get($observatoryURL, $parameters);

        # If everything goes well, process results ..
        if ($observatoryResponse->http_code() === 200) {
            $observatoryData = $observatoryResponse->json(true);

            # .. and cache data for one week (60 * 24 * 7)
            $depsCache->set('observatory', $observatoryData, 10080);
        }
    }

    # Add Observatory score
    $source['observatory'] = [
        'score' => $observatoryData['score'],
        'grade' => $observatoryData['grade'],
    ];


    # Add lines of code
    exec('cd ' . $kirby->root('base') . ' && bash toolset/lines_of_code.bash', $outputLines);

    if (is_array($outputLines) && count($outputLines) >= 1) {
        $source['loc'] = (string) $outputLines[0];
    }


    # Add average commits/month for last three months
    exec('cd ' . $kirby->root('base') . ' && bash toolset/average_commits_per_month.bash', $outputCommits);

    if (is_array($outputCommits) && count($outputCommits) >= 1) {
        $source['activity'] = (string) $outputCommits[0];
    }


    # Fetch cached PHP / Composer packages
    $phpData  = $depsCache->get('phpData');

    # If not cached ..
    if ($phpData === null) {
        $phpData = [];

        # .. load current PHP / Composer packages
        $phpJSON = F::read($kirby->root('base') . '/composer.json');

        # Define blocklist
        $phpBlockList = [
            'php',
        ];

        foreach (json_decode($phpJSON, false)->require as $library => $version) {
            # .. block unwanted libraries (such as `php`)
            if (in_array($library, $phpBlockList) === true) continue;

            # Split maintainer & library name
            $splitList = Str::split($library, '/');

            # .. prepare data for each repository
            $node = [
                'maintainer' => $splitList[0],
                'repo' => $splitList[1],
                'version' => $version,
                'desc' => '',
                'license' => '',
                'url' => '',
            ];

            # .. fetch additional information from https://packagist.org
            $phpURL = 'https://repo.packagist.org/p/' . $library . '.json';
            $phpResponse = Remote::get($phpURL);

            # .. and enrich data with results
            if ($phpResponse->http_code() === 200) {
                $data = $phpResponse->json(true)['packages'][$library]['dev-master'];

                $node['desc'] = $data['description'];
                $node['license'] = $data['license'] ?? '';
                $node['url'] = Str::rtrim($data['source']['url'], '.git');
            }

            $phpData[] = $node;
        }

        # Sort data ..
        array_multisort(
            array_column($phpData, 'maintainer'), SORT_ASC,
            array_column($phpData, 'repo'), SORT_ASC,
            $phpData
        );

        # .. and cache data for one week (60 * 24 * 7)
        $depsCache->set('phpData', $phpData, 10080);
    }


    # Fetch cached JavaScript / Node packages
    $pkgData  = $depsCache->get('pkgData');

    # If not cached ..
    if ($pkgData === null) {
        $pkgData = [];

        # .. load current JavaScript / Node packages
        $pkgJSON = F::read($kirby->root('base') . '/package.json');

        # Define blocklist
        $pkgBlockList = [
            # Nothing so far
        ];

        foreach (json_decode($pkgJSON, false)->dependencies as $library => $version) {
            # .. block unwanted libraries (such as `php`)
            if (in_array($library, $pkgBlockList) === true) continue;

            # .. prepare data for each repository
            $node = [
                'maintainer' => '',
                'repo' => Str::replace($library, '@', ''),
                'version' => $version,
                'desc' => '',
                'url' => '',
                'license' => '',
            ];

            # .. fetch additional information from https://packagist.org
            $pkgURL = 'https://api.npms.io/v2/package/' . rawurlencode($library);
            $pkgResponse = Remote::get($pkgURL);

            # .. and enrich data with results
            if ($pkgResponse->http_code() === 200) {
                $data = $pkgResponse->json(false)->collected->metadata;

                # Split URL & set pointer to last entry
                $splitList = Str::split($data->links->repository, '/');
                end($splitList);

                $node['maintainer'] = prev($splitList);
                $node['desc'] = $data->description;
                $node['license'] = $data->license ?? '';
                $node['url'] = $data->links->repository;
            }

            $pkgData[] = $node;
        }

        # Sort data ..
        array_multisort(
            array_column($pkgData, 'maintainer'), SORT_ASC,
            array_column($pkgData, 'repo'), SORT_ASC,
            $pkgData
        );

        # .. and cache data for one week (60 * 24 * 7)
        $depsCache->set('pkgData', $pkgData, 10080);
    }

    return compact(
        'source',
        'phpData',
        'pkgData',
    );
};
