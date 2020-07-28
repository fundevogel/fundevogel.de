/*
---------------------------------------
Assets - Build
---------------------------------------
*/

import {series, parallel} from 'gulp';

const
    conf = require('../config'),

    {styles} = require('./styles'),
    {scripts} = require('./scripts'),
    {images} = require('./images'),
    {fonts} = require('./fonts'),

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

exports.build = series(
    clean, parallel(
        styles,
        scripts,
        images,
        fonts
    )
);
