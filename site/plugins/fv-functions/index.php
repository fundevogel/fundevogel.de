<?php

use PHPCBIS\PHPCBIS;

function pcbis()
{
    # Initializing PHPCBIS object
    $login = file_get_contents(kirby()->root('config') . '/knv.json');
    $login = json_decode($login, true);

    return new PHPCBIS($login);
}

function getLangVars ($language = 'de')
{
    $translations = Yaml::decode(F::read(
        kirby()->root('languages') . '/vars/' . $language . '.yml')
    );

    return $translations;
}

function useSVG ($title, $classes = '', $file = '', $customAttribute = '')
{
    if ($file === '') {
        $file = str_replace('-', '', $title);
        $file = strtolower($file);
    }

    return '<svg class="' . $classes . '" title="' . $title . '" role="img"' . r($customAttribute !== '', ' ' . $customAttribute) . '><use xlink:href="/assets/images/icons.svg#' . $file . '"></use></svg>';
}

function useSeparator ($color = 'orange-light', $position = 'top') {
    $margin = Str::contains($position, 'top') === true ? '-mb-px' : '-mt-px';

    return '<div class="w-full"><svg class="w-full h-auto ' . $margin . ' fill-current text-' . $color .'" role="img"><use xlink:href="/assets/images/icons.svg#' . $position . '"></use></svg></div>';
}
