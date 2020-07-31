/* eslint-disable @typescript-eslint/no-var-requires */

/*
---------------------------------------
Assets - Scripts
---------------------------------------
*/

import {src, dest, series, lastRun, TaskFunction} from 'gulp';

import conf from '../config';

const
    babel = require('gulp-babel'),
    browserSync = require('browser-sync').init,
    eslint = require('gulp-eslint'),
    named = require('vinyl-named'),
    rename = require('gulp-rename'),
    uglify = require('gulp-uglify'),
    webpack = require('webpack-stream')
;


/*
 * Lints javascript using eslint & caches results (config under eslintConfig in package.json)
 */

function lintScripts() {
    const lintSource = [
        conf.src.scripts + '/**/*.ts',
    ];

    return src(lintSource, {since: lastRun(lintScripts)})
        .pipe(eslint(conf.scripts.linting))
        .pipe(eslint.format());
}


/*
 * Compiles and concatenates javascript
 */

function makeScripts() {
    const scriptsSource = [
        conf.src.scripts + '/' + conf.scripts.input,
    ];

    return src(scriptsSource, {sourcemaps: conf.sourcemaps.enable})
        .pipe(named())
        .pipe(webpack(conf.scripts.webpack))
        .pipe(babel(conf.scripts.babel))
        .pipe(dest(conf.dist.scripts, {sourcemaps: conf.sourcemaps.path}))
        .pipe(browserSync.stream())
    ;
}


/*
 * Minifies javascript (only used in production)
 */

function minifyScripts() {
    const minifySource = [
        conf.dist.scripts + '/**/*.js',
    ];

    return src(minifySource, {sourcemaps: conf.sourcemaps.enable})
        .pipe(uglify())
        .pipe(rename({suffix: '.min'}))
        .pipe(dest(conf.dist.scripts, {sourcemaps: conf.sourcemaps.path}))
    ;
}


/*
 * Exports
 */

let scripts: TaskFunction;

if (process.env.NODE_ENV === 'production') {
    scripts = series(makeScripts, minifyScripts);
} else {
    scripts = series(lintScripts, makeScripts);
}

export = scripts;
