<?php

use S1SYPHOS\Thx;

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

            # FIX: Check for key 'error' meaning no scan could be found / run
            if (!isset($observatoryData['error'])) {
                # .. and cache data for one quarter (60 * 24 * 7 * 4 * 3)
                $depsCache->set('observatory', $observatoryData, 120960);
            }
        }
    }

    # Add Observatory score
    // $source['observatory'] = [
    //     'score' => $observatoryData['score'],
    //     'grade' => $observatoryData['grade'],
    // ];


    # Add lines of code
    exec('cd ' . $kirby->root('base') . ' && bash lib/toolset/lines_of_code.bash', $outputLines);

    if (is_array($outputLines) && count($outputLines) >= 1) {
        $source['loc'] = (string) $outputLines[0];
    }


    # Add average commits/month for last three months
    exec('cd ' . $kirby->root('base') . ' && bash lib/toolset/average_commits_per_month.bash', $outputCommits);

    if (is_array($outputCommits) && count($outputCommits) >= 1) {
        $source['activity'] = (string) $outputCommits[0];
    }

    $languages = $page->languages()->toStructure();


    # Fetch information about packages being used throughout the website
    # Define cache settings
    $cacheConfig = ['storage' => $kirby->root('cache') . '/php-thx'];
    $cacheDuration = 14;  # in days

    # (1) Composer
    $dataFile = $kirby->root('base') . '/composer.json';
    $lockFile = $kirby->root('base') . '/composer.lock';

    $phpDriver = new Thx($dataFile, $lockFile, 'file', $cacheConfig);

    # Block unwanted libraries
    $phpDriver->setBlockList(['php']);

    # Set cache expiry (two weeks)
    $phpDriver->setCacheDuration($cacheDuration);

    # Fetch data
    $phpData = $phpDriver->giveBack()->pkgs();

    # Sort it
    array_multisort(
        array_column($phpData, 'maintainer'), SORT_ASC,
        array_column($phpData, 'name'), SORT_ASC,
        $phpData
    );


    # (2) (Node)JS packages
    $dataFile = $kirby->root('base') . '/package.json';
    $lockFile = $kirby->root('base') . '/yarn.lock';

    $pkgDriver = new Thx($dataFile, $lockFile, 'file', $cacheConfig);

    # Set cache expiry (two weeks)
    $pkgDriver->setCacheDuration($cacheDuration);

    # Fetch data
    $pkgData = $pkgDriver->giveBack()->pkgs();

    # Sort it
    array_multisort(
        array_column($pkgData, 'maintainer'), SORT_ASC,
        array_column($pkgData, 'name'), SORT_ASC,
        $pkgData
    );


    return compact(
        'source',
        'phpData',
        'pkgData',
        'languages',
    );
};
