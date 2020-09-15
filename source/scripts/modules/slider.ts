import EmblaCarousel from 'embla-carousel';

import {forEach} from '../helpers/forEach';

// @ts-ignore
const autoplay = (embla, interval: number) => {
    let timer = 0;

    const play = () => {
        stop();
        requestAnimationFrame(() => (timer = window.setTimeout(next, interval)));
    };

    const stop = () => {
        window.clearTimeout(timer);
        timer = 0;
    };

    const next = () => {
        if (embla.canScrollNext()) {
            embla.scrollNext();
        } else {
            embla.scrollTo(0);
        }

        play();
    };

    return {play, stop};
};

export const runSlider = (container: HTMLElement, template: string) => {
    forEach(container.querySelectorAll('.js-slider'), (slider: HTMLElement) => {
        const options = {
            speed: 4,
            loop: true,
            delay: 4500,
            draggable: false,
        };

        const embla = EmblaCarousel(slider, options);
        const autoplayer = autoplay(embla, options.delay);

        // Start autoplay function upon init
        embla.on('init', autoplayer.play);

        // Resume autoplay after swiping
        embla.on('select', () => {
            autoplayer.stop();
        });

        embla.on('settle', () => {
            autoplayer.play();
        });

        // Stop on mouse hover, resume after it's gone
        slider.addEventListener('mouseenter', () => {
            autoplayer.stop();
        });

        slider.addEventListener('mouseleave', () => {
            autoplayer.play();
        });

        if (template === 'assortment.single' || template === 'lesetipps.article') {
            const pagination = slider.querySelector('.js-controls');
            const bullets = pagination.querySelectorAll('span');

            // Add active class upon init
            embla.on('init', () => {
                forEach(bullets, (bullet: HTMLElement, index: number) => {
                    if (embla.selectedScrollSnap() === index) {
                        bullet.classList.add('bg-red-medium');
                    }
                });
            });

            // Add active class while autoplay is running
            embla.on('scroll', () => {
                forEach(bullets, (bullet: HTMLElement, index: number) => {
                    bullet.classList.remove('bg-red-medium');

                    if (embla.selectedScrollSnap() === index) {
                        bullet.classList.add('bg-red-medium');
                    }
                });
            });

            // Add active class upon click on dot
            forEach(bullets, (bullet: HTMLElement, index: number) => {
                bullet.addEventListener('click', () => {
                    forEach(bullets, (sibling: HTMLElement, index: number) => {
                        sibling.classList.remove('bg-red-medium');
                    });

                    bullet.classList.add('bg-red-medium');
                    embla.scrollTo(index);
                });
            });
        }
    });
};
