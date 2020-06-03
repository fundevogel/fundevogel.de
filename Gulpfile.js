'use strict';

/*
---------------------------------------
I. Prerequisites
---------------------------------------
*/

const
    {series, parallel} = require('gulp'),

    {styles} = require('./lib/gulp/tasks/styles'),
    {scripts} = require('./lib/gulp/tasks/scripts'),
    {images} = require('./lib/gulp/tasks/images'),
    {fonts} = require('./lib/gulp/tasks/fonts'),
    {server} = require('./lib/gulp/tasks/server'),
    {watch} = require('./lib/gulp/tasks/watch'),
    {build} = require('./lib/gulp/tasks/build')
;


/*
---------------------------------------
II. Bringing together the best of all possible worlds
---------------------------------------
*/

module.exports = {
    styles: styles,
    scripts: scripts,
    images: images,
    fonts: fonts,
    build: build,

    default: series(
        build, parallel(
            watch,
            server
        )
    ),
};
