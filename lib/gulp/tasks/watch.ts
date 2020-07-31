/* eslint-disable @typescript-eslint/no-var-requires */

/*
---------------------------------------
Monitoring
---------------------------------------
*/

import {watch, parallel, TaskFunction} from 'gulp';

import conf from '../config';

const
    {styles} = require('./styles'),
    {scripts} = require('./scripts'),
    {images} = require('./images'),
    {fonts} = require('./fonts'),

    browserSync = require('browser-sync').init
;


/*
 * See https://github.com/BrowserSync/browser-sync/issues/711
 */

function reload(done: () => void) {
    browserSync.reload();
    done();
}


/*
 * Watches for changes, recompiles & injects assets
 */

function watchStyles() {
    watch(conf.src.styles + '/**/*.css', styles);
    watch(conf.src.styles + 'tailwind.config.js', styles);
}

function watchScripts() {
    watch(conf.src.scripts + '/**/*.js', scripts);
}

function watchImages() {
    watch(conf.src.images + '/**/*', images);
}

function watchFonts() {
    watch(conf.src.fonts + '/**/*', fonts);
}

function watchCode() {
    watch(conf.watch.code, reload);
}


/*
 * Exports
 */

const watching: TaskFunction = parallel(
    watchStyles,
    watchScripts,
    watchImages,
    watchFonts,
    watchCode
);

export = watching;
