/*
 * IMPORTS
 */

import barba from '@barba/core';

import Layzr from 'layzr.js';

import contains from './helpers/contains';
import jsDetect from './helpers/jsDetect';

import polyfillSVG from './modules/polyfillSVG';
import runForms from './modules/forms';
import runScroll from './modules/infiniteScroll';
import runLightbox from './modules/lightBox';
import runMasonry from './modules/masonry';
import runSlider from './modules/slider';
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
    }

    init() {
        console.info('🚀 App:init');

        jsDetect();
        polyfillSVG();

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
                /*
                 * Generic setup
                 */

                const page = data.next.container;

                // Tooltips
                runTooltips(page);

                // Lazyloading
                lazyload
                    .update()
                    .check()
                    .handlers(true);

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
                        lazyload.update();
                        runLightbox(page);
                    });
                }

                // Dropkick (form element styling)
                if (template === 'lesetipps.browse') {
                    runForms(page);
                }

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

            barba.init({debug: true});
        } catch (err) {
            console.error(err);
        }

        App.showPage();
    }
}

App.start();
