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

import featureDetection from './modules/jsDetect';
import toggleMenu from './modules/toggleMenu';
import forEach from './modules/foreach';
import baguetteBox from '../../../baguetteBox.js/src/baguetteBox';

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

        featureDetection();

        // eslint-disable-next-line new-cap
        const lazyLoading = Layzr({
            normal: 'data-layzr',
            threshold: 250,
        });

        lazyLoading
            .update()
            .check()
            .handlers(true);

        const baguetteBoxSelector = '.js-lightbox';
        const baguetteBoxOptions = {
            theme: 'fundevogel',
            animation: 'fadeIn',
            overlayBackgroundColor: 'rgba(255,249,196,1)',
        };

        function reloadBaguettebox() {
            baguetteBox.destroy();
            baguetteBox.run(baguetteBoxSelector, baguetteBoxOptions);
        }

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

                baguetteBox.run(baguetteBoxSelector, baguetteBoxOptions);

                const toggle = data.next.container.querySelector('.js-toggle');

                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    toggleMenu();
                }, false);

                if (data.next.namespace === 'grid-list' || data.next.namespace === 'calendar') {
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
                                reloadBaguettebox();
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
                                // lazyload: true,
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
                            tns({
                                container: data.next.container.querySelector('.js-slider'),
                                speed: 1500,
                                // lazyload: true,
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
                        namespace: 'lesetipps.browse',
                        beforeEnter(data) {
                            // NodeList:
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
                                // lazyload: true,
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
                                    reloadBaguettebox();
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
