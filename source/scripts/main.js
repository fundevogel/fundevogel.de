/*
 * IMPORTS
 */

import barba from '@barba/core';

import Layzr from 'layzr.js';

import contains from './helpers/contains';
import jsDetect from './helpers/jsDetect';

import runForms from './modules/forms';
import runScroll from './modules/infiniteScroll';
import runLightbox from './modules/lightBox';
import runMasonry from './modules/masonry';
import runSlider from './modules/slider';
import runSVG from './modules/polyfillSVG';
import runTooltips from './modules/toolTips';
import toggleMenu from './modules/toggleMenu';


/*
 * App Class
 */

class App {
    static start() {
        return new App();
    }

    constructor() {
        Promise
            .all([
                App.domReady(),
            ])
            .then(this.init.bind(this));
    }

    static domReady() {
        return new Promise((resolve) => {
            document.addEventListener('DOMContentLoaded', resolve);
        });
    }

    static showPage() {
        document.body.classList.add('app:is-ready');
        console.info('🚀 App:ready');
        jsDetect();
    }

    init() {
        console.info('🚀 App:init');

        // eslint-disable-next-line new-cap
        const lazyload = Layzr({normal: 'data-layzr'});

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
                // Generic setup
                lazyload
                    .update()
                    .check()
                    .handlers(true);

                const page = data.next.container;

                runSVG();
                runTooltips(page);

                const toggle = page.querySelector('.js-toggle');

                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    toggleMenu();
                }, false);


                // Template-specifc setup
                const template = data.next.namespace;

                // Slider
                const hasSlider = [
                    'about',
                    'assortment.single',
                    'lesetipps.article',
                    'calendar.single',
                ];

                if (contains(hasSlider, template)) {
                    runSlider(page, template);
                }

                // Lightbox
                const hasLightbox = [
                    'news',
                    'about',
                    'lesetipps.article',
                    'calendar.single',
                    'contact',
                ];

                if (contains(hasLightbox, template)) {
                    runLightbox(page);
                }

                // Masonry
                const hasMasonry = [
                    'calendar',
                    'grid-list',
                ];

                if (contains(hasMasonry, template)) {
                    runMasonry(page);
                }
            });

            barba.hooks.enter((data) => {
                window.scrollTo(0, 0);

                const toggle = data.current.container.querySelector('.js-toggle');
                const isOpen = toggle.classList.contains('is-active');

                if (isOpen) {
                    toggleMenu();
                }
            });

            // barba.hooks.afterEnter(() => {
            // });

            barba.hooks.after(() => {
                barba.wrapper.classList.remove('app:is-animating');
            });

            barba.init({
                debug: true,
                views: [
                    {
                        namespace: 'news',
                        beforeEnter(data) {
                            const infiniteScroll = runScroll(data.next.container);

                            infiniteScroll.on('append', () => {
                                lazyload.update();
                                runLightbox(data.next.container);
                            });
                        },
                        // afterEnter() {
                        // },
                        // beforeLeave() {
                        // },
                        // afterLeave() {
                        // },
                    },
                    {
                        namespace: 'lesetipps.browse',
                        beforeEnter(data) {
                            runForms(data.next.container);
                        },
                        // afterEnter() {
                        // },
                        // beforeLeave() {
                        // },
                        // afterLeave() {
                        // },
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
