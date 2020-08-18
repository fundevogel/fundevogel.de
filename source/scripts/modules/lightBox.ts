// @ts-ignore
import BigPicture from 'bigpicture';

import forEach from '../helpers/forEach';
import { stringify } from 'querystring';

export default (container: HTMLElement, template: string = '') => {
    forEach(container.querySelectorAll('.js-lightbox'), (value: HTMLElement, index: number) => {
        value.addEventListener('click', () => {
            let defaults = {
                el: value,
                gallery: value.querySelectorAll('img'),
                loop: true,

                // Prevent scrollbar overflow
                animationStart: () => {
                    document.documentElement.style.overflowY = 'hidden';
                    document.body.style.overflowY = 'scroll';
                },
                onClose: () => {
                    document.documentElement.style.overflowY = 'auto';
                    document.body.style.overflowY = 'auto';
                },
            };

            if (template === 'about') {
                const images = value.dataset.images.split(';');
                const captions = value.dataset.captions.split(';');

                const array: {src: string, caption: string}[] = [];

                forEach(images, (url: string, index: number) => {
                    array.push({
                        src: url,
                        caption: captions[index],
                    })
                });

                defaults = Object.assign(defaults, {
                    gallery: array,
                });
            }

            BigPicture(defaults);
        }, false);
    });
};
