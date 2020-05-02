/*
---------------------------------------
Assets - Styles
---------------------------------------
*/

const
    {src, dest, series, lastRun} = require('gulp'),
    conf = require('../config'),

    browserSync = require('browser-sync').init,
    gulpif = require('gulp-if'),
    minify = require('gulp-clean-css'),
    postcss = require('gulp-postcss'),
    precss = require('precss'),
    prefix = require('autoprefixer'),
    // purgecss = require('@fullhuman/postcss-purgecss'),
    rename = require('gulp-rename'),
    stylelint = require('gulp-stylelint'),
    // sass = require('gulp-sass'),
    tailwind = require('tailwindcss')
;


/*
 * Lints styles using stylelint (config under 'stylelint' in package.json)
 */

function lintStyles() {
    const lintSource = [
        conf.src.styles + '/**/*.scss',
        '!' + conf.src.styles + '/vendor/**/*.scss',
    ];

    return src(lintSource, {since: lastRun(lintStyles)})
    // For more options, see http://stylelint.io/user-guide/example-config/
        .pipe(stylelint(conf.styles.linting))
        .pipe(gulpif(conf.styles.linting.fix == true, dest(conf.src.styles)))
    ;
}


/*
 * Compiles SASS files into CSS
*/

function makeStyles() {
    const stylesSource = [
        conf.src.styles + '/*.css',
    ];

    const plugins = [
        precss(),
        tailwind(conf.src.styles + '/tailwind.config.js'),
        prefix(conf.styles.prefix),
        // purgecss({
        //     content: [
        //         './**/*.html',
        //     ],
        //     // Include any special characters you're using in this regular expression
        //     defaultExtractor: content => content.match(/[\w-/:]+(?<!:)/g) || []
        // }),
    ];

    return src(stylesSource, {sourcemaps: conf.sourcemaps.enable})
        .pipe(postcss(plugins))
        .pipe(dest(conf.dist.styles, {sourcemaps: conf.sourcemaps.path}))
        .pipe(browserSync.stream())
    ;
}


/*
 * Minifies stylesheets (only used in production)
 */

function minifyStyles() {
    const minifySource = [
        conf.dist.styles + '/**/*.css',
    ];

    return src(minifySource, {sourcemaps: conf.sourcemaps.enable})
        .pipe(minify())
        .pipe(rename({suffix: '.min'}))
        .pipe(dest(conf.dist.styles, {sourcemaps: conf.sourcemaps.path}))
    ;
}


/*
 * Exports
 */

if (process.env.NODE_ENV === 'production') {
    // exports.styles = series(makeStyles, minifyStyles);
    exports.styles = makeStyles;
} else {
    exports.styles = series(lintStyles, makeStyles);
}
