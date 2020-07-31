/* eslint-disable @typescript-eslint/no-var-requires */

/*
---------------------------------------
Assets - Build
---------------------------------------
*/

import {series, parallel} from 'gulp';

import conf from '../config';

const
    styles = require('./styles'),
    scripts = require('./scripts'),
    images = require('./images'),
    fonts = require('./fonts'),

    del = require('del')
;


/*
 * Cleans assets folder
 */

function clean() {
    return del(Object.values(conf.dist));
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
    )
);

export = build;
