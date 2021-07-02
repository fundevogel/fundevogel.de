/* eslint-disable @typescript-eslint/no-var-requires */

/*
---------------------------------------
Assets - Build
---------------------------------------
*/

import {src, dest, series, parallel} from 'gulp';

import conf from '../config';

const
    styles = require('./styles'),
    scripts = require('./scripts'),
    images = require('./images'),
    fonts = require('./fonts'),

    del = require('del'),
    rev = require('gulp-rev')
;


/*
 * Cleans assets folder
 */

function clean() {
    return del(Object.values(conf.dist));
}


/*
 * Generate revision manifest
 */

function revision() {
	return src([conf.dist.styles + '/*.min.css', conf.dist.scripts + '/*.min.js'], {base: conf.public})
		.pipe(rev())
		.pipe(dest(conf.public))
		.pipe(rev.manifest('manifest.json'))
		.pipe(dest(conf.assets))
}


/*
 * Exports
 */

const build = series(
    clean, parallel(
        styles,
        scripts,
        images,
        fonts
    ), revision
);

export = build;
