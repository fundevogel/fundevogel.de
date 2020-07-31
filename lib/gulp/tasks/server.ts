/* eslint-disable @typescript-eslint/no-var-requires */

/*
---------------------------------------
Development / Deployment
---------------------------------------
*/

import {parallel, TaskFunction} from 'gulp';

import conf from '../config';

const
    browserSync = require('browser-sync').init,
    php = require('gulp-connect-php')
;


/*
 * Starts a local development server (using PHP)
 */

function connect() {
    php.server(conf.server.connect);
}


/*
 * Starts a live reload proxy via Browsersync
 */

function livereload(): void {
    browserSync.init(conf.browsersync);
}


/*
 * Exports
 */

let server: TaskFunction;

if (conf.server.enable) {
    server = parallel(
        connect,
        livereload
    );
} else {
    server = livereload;
}

export = server;
