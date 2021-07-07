<?php

function loadCSS ()
{
    # (1) When in production ..
    if (option('environment') == 'production') {
        # .. provide `style` tag & minified inline CSS
        return '<style nonce="' . site()->nonce() . '">' . F::read(kirby()->root('assets') . '/styles/main.min.css') . '</style>';
    }

    # (2) Otherwise, provide `link` tag & unminified CSS file
    return css('assets/styles/main.css');
}


function loadJS ()
{
    # Determine base path
    $jsPath = url('assets/scripts/');

    # (1) When in production ..
    if (option('environment') == 'production') {
        # .. provide `script` tag & minified inline CSS
        return Bnomei\Fingerprint::js($jsPath . 'main.min.js', [
            'nonce' => site()->nonce(),
            'defer' => true,
            'integrity' => true,
        ]);
    }

    return js($jsPath . 'main.js');
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

    $svgPath = 'assets/images/icons/' . $file . '.svg';
    $svg = (new Asset($svgPath))->read();

    return Str::replace($svg, '<svg', '<svg class="' . $classes . '" title="' . $title . '" role="img"' . r($customAttribute !== '', ' ' . $customAttribute), 1);
}

function useSeparator ($color = 'orange-light', $position = 'top') {
    $svgPath = 'assets/images/icons/' . $position . '.svg';
    $svg = (new Asset($svgPath))->read();

    $margin = Str::contains($position, 'top') === true ? '-mb-px' : '-mt-px';

    return '<div class="w-full">' . Str::replace($svg, '<svg', '<svg class="w-full h-auto ' . $margin . ' fill-current text-' . $color .'" role="img"', 1) . '</div>';
}
