<?php

##
# HOOKS
##

return [
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
