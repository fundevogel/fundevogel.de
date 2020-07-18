/* eslint-disable max-len */

/*
 * IMPORTS
 */

import barba from '@barba/core';
import InfiniteScroll from 'infinite-scroll';
import Layzr from 'layzr.js';
import macy from 'macy';
import svg4everybody from 'svg4everybody';
import tippy, {roundArrow} from 'tippy.js';
import {tns} from 'tiny-slider/src/tiny-slider.module';

import jsDetect from './modules/jsDetect';
import toggleMenu from './modules/toggleMenu';
import forEach from './modules/forEach';
import getClosest from './modules/getClosest';

import runLightbox from './modules/lightBox';
import Dropkick from 'dropkickjs';

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

        // eslint-disable-next-line new-cap
        const lazyLoading = Layzr({normal: 'data-layzr'});

        lazyLoading
            .update()
            .check()
            .handlers(true);

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
                svg4everybody({
                    polyfill: true,
                });

                // TODO: Outsource `runTooltips`
                tippy(data.next.container.querySelectorAll('.js-tippy'), {
                    theme: 'fundevogel orange',
                    duration: [350, 150],
                    offset: [0, 20],
                    arrow: roundArrow,
                    plugins: [],
                    // Use `title` attribute as content
                    content(reference) {
                        const title = reference.getAttribute('title');
                        reference.removeAttribute('title');
                        return title;
                    },
                });

                lazyLoading
                    .update()
                    .check();

                runLightbox(data.next.container);

                const toggle = data.next.container.querySelector('.js-toggle');

                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    toggleMenu();
                }, false);

                if (data.next.namespace === 'grid-list' || data.next.namespace === 'calendar') {
                    // TODO: Outsource `runMasonry`
                    macy({
                        container: data.next.container.querySelector('#macy'),
                        trueOrder: false,
                        columns: 3,
                        margin: 16,
                        breakAt: {
                            767: 1,
                            1279: 2,
                        },
                    });
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
                            // TODO: `runInfiniteScroll`
                            const infiniteScroll = new InfiniteScroll(data.next.container.querySelector('.js-list'), {
                                hideNav: '.js-hide',
                                button: '.js-more',
                                path: '.js-target',
                                append: '.js-article',
                                scrollThreshold: 750,
                                history: false,
                            });

                            infiniteScroll.on('append', () => {
                                lazyLoading.update();
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
                        namespace: 'about',
                        beforeEnter(data) {
                            tns({
                                container: data.next.container.querySelector('.js-slider'),
                                mode: 'gallery',
                                speed: 1000,
                                autoplay: true,
                                autoplayTimeout: 3500,
                                autoplayHoverPause: true,
                                autoplayButtonOutput: false,
                                nav: false,
                                controls: false,
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
                        namespace: 'assortment.single',
                        beforeEnter(data) {
                            // TODO: Outsource `runSlider`
                            tns({
                                container: data.next.container.querySelector('.js-slider'),
                                speed: 1500,
                                autoplay: true,
                                autoplayTimeout: 5000,
                                autoplayHoverPause: true,
                                autoplayButtonOutput: false,
                                nav: true,
                                navContainer: data.next.container.querySelector('.js-controls'),
                                controls: false,
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
                        namespace: 'lesetipps.article',
                        beforeEnter(data) {
                            forEach(data.next.container.querySelectorAll('.js-slider'), function(value, index) {
                                tns({
                                    container: value,
                                    speed: 1500,
                                    // lazyload: true,
                                    autoplay: true,
                                    autoplayTimeout: 5000,
                                    autoplayHoverPause: true,
                                    autoplayButtonOutput: false,
                                    nav: true,
                                    navContainer: getClosest(value, '.wave').querySelector('.js-controls'),
                                    controls: false,
                                });
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
                            forEach(data.next.container.querySelectorAll('.js-select'), function(value, index) {
                                value.onchange = function() {
                                    // if (this.selectedIndex !== 0) {
                                    window.location.href = this.value;
                                    // }
                                };

                                new Dropkick(value);
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
                        namespace: 'calendar.single',
                        beforeEnter(data) {
                            tns({
                                container: data.next.container.querySelector('.js-slider'),
                                items: 2,
                                slideBy: 1,
                                speed: 2500,
                                edgePadding: 40,
                                center: true,
                                autoplay: true,
                                autoplayTimeout: 5000,
                                autoplayHoverPause: true,
                                autoplayButtonOutput: false,
                                nav: false,
                                controls: false,
                                responsive: {
                                    1024: {
                                        items: 3,
                                        slideBy: 2,
                                    },
                                },
                                onInit: function() {
                                    runLightbox(data.next.container);
                                },
                            });
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
