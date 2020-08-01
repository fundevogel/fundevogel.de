<?php

# TODO: Add 'forked' status, eg `bigpicture
# TODO: Add card layout`

return function ($kirby, $page) {
    $blockList = [
        'php',
    ];

    # Initialize dependency cache
    $depsCache = $kirby->cache('deps');

    # Fetch cached JavaScript / Node packages
    $pkgData  = $depsCache->get('pkgData');

    # If not cached ..
    if ($pkgData === null) {
        $pkgData = [];

        # .. load current JavaScript / Node packages
        $pkgJSON = F::read($kirby->root('base') . '/package.json');

        foreach (json_decode($pkgJSON, false)->dependencies as $library => $version) {
            # .. block unwanted libraries (such as `php`)
            if (in_array($library, $blockList) === true) continue;

            # .. prepare data for each repository
            $repo = [
                'author' => '',
                'name' => Str::replace($library, '@', ''),
                'version' => $version,
                'desc' => '',
                'url' => '',
                'license' => '',
            ];

            # .. fetch additional information from https://packagist.org
            $pkgURL = 'https://api.npms.io/v2/package/' . rawurlencode($library);
            $repoData = Remote::get($pkgURL);

            # .. and enrich data with results
            if ($repoData->http_code() === 200) {
                $data = $repoData->json(false)->collected->metadata;

                # Split URL & set pointer to last entry
                $package = Str::split($data->links->repository, '/');
                end($package);

                $repo['author'] = prev($package);
                $repo['desc'] = $data->description;
                $repo['license'] = $data->license ?? '';
                $repo['url'] = $data->links->repository;
            }

            $pkgData[] = $repo;
        }

        # Sort data ..
        array_multisort(
            array_column($pkgData, 'author'), SORT_ASC,
            array_column($pkgData, 'name'), SORT_ASC,
            $pkgData
        );

        # .. and cache it for one week (60 * 24 * 7)
        $depsCache->set('pkgData', $pkgData, 10080);
    }

    # Fetch cached PHP / Composer packages
    $phpData  = $depsCache->get('phpData');

    # If not cached ..
    if ($phpData === null) {
        $phpData = [];

        # .. load current PHP / Composer packages
        $composerJSON = F::read($kirby->root('base') . '/composer.json');

        foreach (json_decode($composerJSON, false)->require as $library => $version) {
            # .. block unwanted libraries (such as `php`)
            if (in_array($library, $blockList) === true) continue;

            # Split author & library name
            $package = Str::split($library, '/');

            # .. prepare data for each repository
            $repo = [
                'author' => $package[0],
                'name' => $package[1],
                'version' => $version,
                'desc' => '',
                'license' => '',
                'url' => '',
            ];

            # .. fetch additional information from https://packagist.org
            $phpURL = 'https://repo.packagist.org/p/' . $library . '.json';
            $repoData = Remote::get($phpURL);

            # .. and enrich data with results
            if ($repoData->http_code() === 200) {
                $data = $repoData->json(true)['packages'][$library]['dev-master'];

                $repo['desc'] = $data['description'];
                $repo['license'] = $data['license'][0];
                $repo['url'] = Str::rtrim($data['source']['url'], '.git');
            }

            $phpData[] = $repo;
        }

        # Sort data ..
        array_multisort(
            array_column($phpData, 'author'), SORT_ASC,
            array_column($phpData, 'name'), SORT_ASC,
            $phpData
        );

        # .. and cache it for one week (60 * 24 * 7)
        $depsCache->set('phpData', $phpData, 10080);
    }

    return compact(
        'pkgData',
        'phpData',
    );
};
