import Swiper, {Autoplay, Pagination, EffectFade} from 'swiper';

import forEach from '../helpers/forEach';

function getPreset(element, template) {
    const defaults = {
        init: false,
        speed: 2500,
        loop: true,
        simulateTouch: false,
        autoplay: {
            delay: template === 'about' ? 3500 : 4500,
        },
    };

    const presets = {
        'about': {
            speed: 1000,
            effect: 'fade',
        },
        'calendar.single': {
            slidesPerView: 2,
            slidesPerGroup: 1,
            breakpoints: {
                1024: {
                    slidesPerView: 3,
                },
                1280: {
                    slidesPerView: 4,
                    slidesPerGroup: 2,
                },
            },
            spaceBetween: 40,
            centeredSlides: true,
        },
    };

    // Common preset for 'assortment.single' & 'lesetipps.article'
    if (template === 'assortment.single' || template === 'lesetipps.article') {
        return Object.assign(defaults, {
            speed: 1500,
        });
    }

    return Object.assign(defaults, presets[template]);
}

export default (container, template) => {
    forEach(container.querySelectorAll('.js-slider'), (value, index) => {
        // Use modules
        Swiper.use([Autoplay, Pagination, EffectFade]);

        const options = getPreset(value, template);
        const swiper = new Swiper(value, options);

        if (swiper.autoplay.running) {
            value.addEventListener('mouseenter', (e) => {
                swiper.autoplay.stop();
            });

            value.addEventListener('mouseleave', (e) => {
                swiper.autoplay.start();
            });
        }

        if (template === 'assortment.single' || template === 'lesetipps.article') {
            const pagination = value.querySelector('.js-controls');
            const bullets = pagination.querySelectorAll('span');

            forEach(bullets, (bullet, index) => {
                bullet.addEventListener('click', (e) => {
                    forEach(bullets, (sibling, index) => {
                        sibling.classList.remove('is-active');
                    });

                    bullet.classList.add('is-active');
                    swiper.slideTo(index + 1);
                });
            });

            swiper.on('init', () => {
                forEach(bullets, (bullet, index) => {
                    if (swiper.realIndex === index) {
                        bullet.classList.add('is-active');
                    }
                });
            });

            swiper.on('autoplay', () => {
                forEach(bullets, (bullet, index) => {
                    bullet.classList.remove('is-active');

                    if (swiper.realIndex === index) {
                        bullet.classList.add('is-active');
                    }
                });
            });
        }

        swiper.init();
    });
};
