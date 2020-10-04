import EmblaCarousel from 'embla-carousel';

import {forEach} from '../helpers/forEach';

export const runSlider = (container: HTMLElement, template: string) => {
    forEach(container.querySelectorAll('.js-slider'), (slider: HTMLElement) => {
        const options = {
            speed: 4,
            loop: true,
            delay: 4500,
            draggable: false,
        };

        const embla = EmblaCarousel(slider, options);

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
