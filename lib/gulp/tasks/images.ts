/* eslint-disable @typescript-eslint/no-var-requires */

/*
---------------------------------------
Assets - Images & Icons
---------------------------------------
*/

import {src, dest, series, parallel, lastRun, TaskFunction} from 'gulp';

import conf from '../config';

const
    browserSync = require('browser-sync').init,
    favicons = require('gulp-favicons'),
    filter = require('gulp-filter'),
    flatten = require('gulp-flatten'),
    imagemin = require('gulp-imagemin'),
    newer = require('gulp-newer'),
    rename = require('gulp-rename'),
    webp = require('gulp-webp')
;


/*
 * Minifies images losslessly
 */

function compressImages() {
    const filetypes = conf.images.allowed.join(',');
    const imagesSource = [
        conf.src.images + '/**/*.{' + filetypes + '}',
    ];

    return src(imagesSource, {since: lastRun(compressImages)})
        .pipe(imagemin(conf.images.minify))
        .pipe(dest(conf.dist.images))
        .pipe(browserSync.stream())
    ;
}


/*
 * Convert images to WebP format
 */

function convertWebP() {
    const filetypes = conf.images.allowed.join(',');
    const imagesSource = [
        conf.dist.images + '/**/*.{' + filetypes + '}',
    ];

    return src(imagesSource, {since: lastRun(convertWebP)})
		.pipe(webp())
        .pipe(dest(conf.dist.images))
    ;
}


/*
 * Compresses SVG icons & combines them to a sprite
 */

function combineIcons() {
    const iconsSource = [
        conf.src.icons + '/**/*.svg',
    ];

    return src(iconsSource)
        .pipe(newer(conf.dist.icons))
        .pipe(flatten())
        .pipe(dest(conf.dist.icons))
        .pipe(browserSync.stream())
    ;
}


/*
 * Generates a set of favicons (only used in production & when enabled, see `config.js#favicons.enable`)
 */

function createFavicons() {
    const snippet = filter('**/' + conf.favicons.snippet, {restore: true});
    const faviconSource = conf.src.images + '/' + conf.favicons.input;

    return src(faviconSource)
        .pipe(favicons(conf.favicons.options))
        .pipe(imagemin(conf.images.minify))
        .pipe(snippet)
        .pipe(rename({extname: '.php'}))
        .pipe(snippet.restore)
        .pipe(dest(conf.public + '/favicons'));
}


/*
 * Exports
 */

let images: TaskFunction;

if (conf.favicons.enable && process.env.NODE_ENV === 'production') {
    images = parallel(
        createFavicons,
        combineIcons,
        series(compressImages, convertWebP)
    );
} else {
    images = parallel(
        combineIcons,
        series(compressImages, convertWebP)
    );
}

export = images;
