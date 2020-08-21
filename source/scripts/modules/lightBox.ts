// @ts-ignore
import BigPicture from 'bigpicture';

import {forEach} from '../helpers/forEach';

export const runLightbox = (container: HTMLElement, template: string = '') => {
    let options = {
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

    forEach(container.querySelectorAll('.js-lightbox'), (value: HTMLElement, index: number) => {
        const images = value.querySelectorAll('img');

        options = Object.assign(options, {
            gallery: images,
        });

        if (template === 'about') {
            const urls = value.dataset.images.split(';');
            const captions = value.dataset.captions.split(';');

            const items: {src: string, caption: string}[] = [];

            forEach(urls, (url: string, index: number) => {
                items.push({
                    src: url,
                    caption: captions[index],
                })
            });

            options = Object.assign(options, {
                gallery: items,
            });
        }

        forEach(images, (image: HTMLElement, index: number) => {
            image.addEventListener('click', (e) => {
                BigPicture(Object.assign(options, {
                    el: e.target,
                }));
            }, false);
        });
    });
};
