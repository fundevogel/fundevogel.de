/*
 * Imports
 */

import barba from '@barba/core';

import jsDetect from './helpers/jsDetect';
import contains from './helpers/contains';

import lazyLoading from './modules/lazyLoading';
import polyfillSVG from './modules/polyfillSVG';
import runChartLabels from './modules/chartLabels';
import runForms from './modules/forms';
import runScroll from './modules/infiniteScroll';
import runLightbox from './modules/lightBox';
import runMasonry from './modules/masonry';
import runSlider from './modules/slider';
import runTooltips from './modules/toolTips';
import {toggleMenu} from './modules/toggleMenu';


/*
 * App Class
 */

class App {
    public hasSlider: string[];
    public hasLightbox: string[];
    public hasMasonry: string[];

    static start() {
        return new App();
    }

    constructor() {
        Promise
            .all([
                App.domReady(),
            ])
            .then(this.init.bind(this));

        this.hasLightbox = [
            'news',
            'about',
            'lesetipps.article',
            'calendar.single',
            'contact',
        ];

        this.hasSlider = [
            'assortment.single',
            'lesetipps.article',
        ];

        this.hasMasonry = [
            'about.team',
            'assortment',
            'assortment.single',
            'lesetipps.archive',
            'calendar',
            'calendar.single',
            'grid-list',
        ];
    }

    static domReady() {
        return new Promise((resolve) => {
            document.addEventListener('DOMContentLoaded', resolve);
        });
    }

    static showPage() {
        document.body.classList.add('app:is-ready');
        console.info('🚀 App:ready');
    }

    init() {
        console.info('🚀 App:init');

        jsDetect();
        polyfillSVG();
        lazyLoading();

        // Avoid 'blank page' on JS error
        try {
            barba.hooks.before(() => {
                barba.wrapper.classList.add('app:is-animating');
            });

            // barba.hooks.beforeLeave(() => {
            // });

            // barba.hooks.leave(() => {
            // });

            // barba.hooks.afterLeave(() => {
            // });

            barba.hooks.beforeEnter((data) => {
                window.scrollTo(0, 0);

                /*
                 * Generic setup
                 */

                const page = data.next.container;

                // Tooltips
                runTooltips(page);


                // Menu (@mobile)
                const toggle = page.querySelector('.js-toggle');

                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    toggleMenu();
                }, false);


                /*
                 * Template-specifc setup
                 */

                const template = data.next.namespace;

                // Infinite scrolling
                if (template === 'news') {
                    const infiniteScroll = runScroll(page);

                    infiniteScroll.on('append', () => {
                        runLightbox(page);
                    });
                }

                // Dropkick (form element styling)
                if (template === 'lesetipps.browse') {
                    runForms(page);
                }

                // Coloring chart labels
                if (template === 'dependencies') {
                    runChartLabels(page);
                }

                // Slider
                if (contains(this.hasSlider, template)) {
                    runSlider(page, template);
                }

                // Lightbox
                if (contains(this.hasLightbox, template)) {
                    runLightbox(page, template);
                }

                // Masonry
                if (contains(this.hasMasonry, template)) {
                    runMasonry(page, template);
                }
            });

            // barba.hooks.enter(() => {
            // });

            // barba.hooks.afterEnter(() => {
            // });

            barba.hooks.after(() => {
                barba.wrapper.classList.remove('app:is-animating');
            });

            barba.init({
                debug: true,
                timeout: 5000,
                transitions: [
                    {
                        name: 'mobileMenu',
                        // @ts-ignore
                        custom: ({ trigger }) => <HTMLElement>trigger.classList && trigger.classList.contains('js-link'),
                        enter() {
                            toggleMenu();
                        },
                    },
                ],
            });
        } catch (err) {
            console.error(err);
        }

        App.showPage();
    }
}

App.start();
