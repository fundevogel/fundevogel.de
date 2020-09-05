/* eslint-disable @typescript-eslint/no-var-requires */

/*
---------------------------------------
Assets - Styles
---------------------------------------
*/

import {src, dest, series, parallel, lastRun, TaskFunction} from 'gulp';

import conf from '../config';

const
    browserSync = require('browser-sync').init,
    concat = require('gulp-concat'),
    fs = require('fs'),
    gulpif = require('gulp-if'),
    minify = require('gulp-clean-css'),
    penthouse = require('penthouse'),
    postcss = require('gulp-postcss'),
    precss = require('precss'),
    prefix = require('autoprefixer'),
    rename = require('gulp-rename'),
    stylelint = require('gulp-stylelint'),
    tailwind = require('tailwindcss')
;


/*
 * Lints styles using stylelint (config under 'stylelint' in package.json)
 */

function lintStyles() {
    const lintSource = [
        conf.src.styles + '/**/*.css',
        '!' + conf.src.styles + '/vendor/**/*.css',
    ];

    return src(lintSource, {since: lastRun(lintStyles)})
    // For more options, see http://stylelint.io/user-guide/example-config/
        .pipe(stylelint(conf.styles.linting))
        .pipe(gulpif(conf.styles.linting.fix == true, dest(conf.src.styles)))
    ;
}


/*
 * Compiles styles via PostCSS
*/

function makeStyles() {
    const stylesSource = [
        conf.src.styles + '/*.css',
    ];

    const plugins = [
        precss(),
        tailwind(conf.src.styles + '/tailwind.config.ts'),
        prefix(conf.styles.prefix),
    ];

    return src(stylesSource, {sourcemaps: conf.sourcemaps.enable})
        .pipe(postcss(plugins))
        .pipe(dest(conf.dist.styles, {sourcemaps: conf.sourcemaps.path}))
        .pipe(browserSync.stream())
    ;
}


/*
 * Extracts critical CSS (only used in production)
 */

function extractCritical(cb: Function) {
    if (!fs.existsSync(conf.dist.critical)){
        fs.mkdirSync(conf.dist.critical);
    }

    const urls = conf.styles.critical.urls.map((url: string) => {
        return conf.styles.critical.base + url;
    });

    urls.push(conf.styles.critical.base);

    const extractCSS = () => {
        const url = urls.pop();

        if (!url) {
            return Promise.resolve();
        }

        const list = url.split('/');
        let identifier = list[list.length - 1];

        if (urls.length === 0) {
            identifier = 'index';
        }

        return penthouse({
            url,
            ...conf.styles.critical.penthouse
        })
        .then((criticalCSS: string) => {
            fs.writeFileSync(conf.dist.critical + '/' + identifier + '.css', criticalCSS);

            return extractCSS();
        })
    }

    Promise.all([
        extractCSS(),
        extractCSS(),
        extractCSS(),
        extractCSS(),
        extractCSS(),
    ]).then(() => {
        src(conf.dist.critical + '/*.css')
            .pipe(concat('critical.css'))
            .pipe(minify(conf.styles.minify))
            .pipe(dest(conf.dist.styles))
        ;
    });

    cb();
}


/*
 * Minifies stylesheets (only used in production)
 */

function minifyStyles() {
    const minifySource = [
        conf.dist.styles + '/main.css',
    ];

    return src(minifySource, {sourcemaps: conf.sourcemaps.enable})
        .pipe(minify(conf.styles.minify))
        .pipe(rename({suffix: '.min'}))
        .pipe(dest(conf.dist.styles, {sourcemaps: conf.sourcemaps.path}))
    ;
}


/*
 * Exports
 */

let styles: TaskFunction;

if (conf.styles.critical.enable && process.env.NODE_ENV === 'production') {
    styles = series(
        makeStyles,
        parallel(minifyStyles, extractCritical)
    );
} else if (process.env.NODE_ENV === 'production') {
    styles = series(makeStyles, minifyStyles);
} else {
    styles = series(lintStyles, makeStyles);
}

export = styles;
