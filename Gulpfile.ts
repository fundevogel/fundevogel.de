'use strict';

/*
---------------------------------------
I. Prerequisites
---------------------------------------
*/

import {series, parallel} from 'gulp';

import styles from './lib/gulp/tasks/styles';
import scripts from './lib/gulp/tasks/scripts';
import images from './lib/gulp/tasks/images';
import fonts from './lib/gulp/tasks/fonts';
import server from './lib/gulp/tasks/server';
import watching from './lib/gulp/tasks/watch';
import build from './lib/gulp/tasks/build';


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
            watching,
            server,
        ),
    ),
};
