<?php

##
# HOOKS
##

return [
    'kirbytext:after' => function ($text) {
        // See https://forum.getkirby.com/t/add-classes-to-textarea-field-output/14060/5
        $from = [];
        $from[0] = '/<p>/';
        $from[1] = '/<ul>/';
        $from[2] = '/<ol>/';

        $to = [];
        $to[0] = '<p class="content">';
        $to[2] = '<ol class="list">';
        $to[1] = '<ul class="list">';

        return preg_replace($from, $to, $text);
    },
    'file.create:after' => function ($file) {
        if ($file->template() == 'pdf') {
            $extension = 'jpg';
            $inputFile = $file->root();
            $outputFile = $file->root() . '.' . $extension;
            $fileName = basename($outputFile);

            if (!f::exists($outputFile) || (f::modified($outputFile) < $file->modified())) {
                $im = new Imagick();
                $im->setResolution(200, 200);
                $im->readImage($inputFile . '[0]');
                // $im->setImageBackgroundColor('white');
                $im->setImageAlphaChannel(imagick::ALPHACHANNEL_REMOVE);
                $im->setImageFormat($extension);
                $im->setImageCompression(Imagick::COMPRESSION_JPEG);
                $im->writeImage($outputFile);
                $im->clear();

                new File([
                    'filename' => $fileName,
                    'parent'   => $file->parent(),
                ]);
            }
        }
    },
];
