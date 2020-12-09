import pngquant from 'imagemin-pngquant';
import pkg from '../../package.json';

const
    src = 'source/',
    root = 'public/',
    dist = root + 'assets/',
    localURL = 'https://192.168.69.69:8080',
    faviconSnippet = 'favicons.html'
;

const conf: Record<string, any> = {
    public: root,
    src: {
        styles: src + 'styles',
        scripts: src + 'scripts',
        images: src + 'images',
        icons: src + 'images/icons',
        fonts: src + 'fonts',
    },
    dist: {
        styles: dist + 'styles',
        critical: dist + 'styles/critical',
        scripts: dist + 'scripts',
        images: dist + 'images',
        icons: dist + 'images/icons',
        fonts: dist + 'fonts',
    },
    styles: {
        linting: {
            // For more options, see https://github.com/olegskl/gulp-stylelint#formatters
            fix: false,
            failAfterError: false,
            reporters: [{
                formatter: 'string',
                console: true,
            }],
        },
        sass: {
            // For more options, see https://github.com/sass/node-sass#options
            precision: 10, // https://github.com/sass/sass/issues/1122
            includePaths: ['node_modules'],
        },
        prefix: {
            // For more options, see https://github.com/postcss/autoprefixer#options
        },
        critical: {
            enable: false,
            base: localURL,
            urls: [
                '/fundevogel-und-team',
                '/unser-sortiment',
                '/lesetipps',
                '/kalender',
                '/unser-service',
                '/unser-netzwerk',
                '/kontakt',
            ],
            penthouse: {
                // For more options, see https://github.com/pocketjoso/penthouse#options
                css: dist + 'styles/main.css',
                renderWaitTime: 3000,
            },
        },
        minify: {
            // For more options, see https://github.com/jakubpawlowicz/clean-css#constructor-options
            level: 2,
        },
    },
    scripts: {
        input: 'main.ts', // Place it in your `src` + `scripts` directory
        linting: {}, // For more options, see https://github.com/adametry/gulp-eslint#eslintoptions
        webpack: {
            mode: 'none',
            watch: false,
            devtool: 'inline-source-map',
            module: {
                rules: [
                    {
                        test: /\.tsx?$/,
                        use: 'ts-loader',
                        exclude: /node_modules/,
                    },
                ],
            },
            resolve: {
                extensions: ['.ts', '.js'],
            },
        },
        babel: {
            presets: ['@babel/preset-env'],
        },
    },
    images: {
        allowed: ['png', 'jpg', 'jpeg', 'gif'],
        minify: {
            progressive: true,
            use: [pngquant()],
        },
    },
    icons: {
        minify: {
            plugins: [{
                removeDoctype: false,
            },
            {
                removeComments: false,
            },
            // {
            //   cleanupNumericValues: {
            //     floatPrecision: 1,
            //   },
            // },
            {
                convertColors: {
                    names2hex: false,
                    rgb2hex: false,
                },
            }],
        }, // For more options, see https://github.com/ben-eb/gulp-svgmin#plugins
    },
    fonts: {
        allowed: ['ttf', 'woff', 'woff2'], // For example, generating from OTF without shipping source files
    },
    server: {
        enable: true,
        connect: {
            // For more options, see https://github.com/micahblu/gulp-connect-php#options
            base: '.',
            router: 'vendor/getkirby/cms/router.php',
        },
    },
    browsersync: {
    // For more options, see https://browsersync.io/docs/options
        proxy: localURL,
        port: 4000,
        notify: true,
        open: true,
        online: false,
    },
    watch: {
        code: [
            'site/**/*.{php,yml}',
            'content/**/*',
        ],
    },
    sourcemaps: {
        enable: true,
        path: '.', // This defaulfs to `dist` + `styles` & `dist` + `scripts`
    },
    favicons: {
        enable: true,
        input: 'logo_square.png', // Place it in your `src` + `images` directory
        snippet: faviconSnippet,
        options: {
            // For more options, see https://github.com/itgalaxy/favicons
            path: '/favicons/',
            appName: 'Kinder- und Jugendbuchhandlung Fundevogel',
            appShortName: 'Fundevogel',
            developerName: 'Martin Folkers',
            developerURL: 'https://twobrain.io',
            // The following are taken from `package.json` to prevent duplicate code
            appDescription: pkg.description,
            url: pkg.homepage,
            version: pkg.version,
            lang: 'de-DE',
            background: '#fafafa',
            theme_color: '#f0694b',
            start_url: '/',
            pipeHTML: true,
            html: '../../../site/snippets/' + faviconSnippet,
            icons: {
                // By default, only `android`, `appleIcon` & `windows` are enabled
                appleStartup: false,
                coast: false,
                favicons: false, // See https://forum.getkirby.com/t/how-to-make-a-proper-compressed-favicon-ico/2725
                firefox: false,
                yandex: false,
            },
        },
    },
    subsetting: {
        // For more options, see https://github.com/filamentgroup/glyphhanger
        enable: true,
        presets: {
            'CabinSketch': 'CabinSketch-Bold',
            'Dosis-Light': 'Dosis-Light',
            'Dosis-Medium': 'Dosis-Medium',
            'Dosis-Bold': 'Dosis-Bold',
        },
        urls: false,
        // Available formats: 'ttf', 'woff', 'woff-zopfli', 'woff2'
        formats: ['ttf', 'woff-zopfli', 'woff2'],
        spider: false,
        spiderlimit: 0,
        latin: true,
        us_ascii: false,
        whitelist: {
            'Dosis-Bold': '×', // .list li::before
        },
        css_selector: false,
        output_css: false,
    },
};

export = conf;
