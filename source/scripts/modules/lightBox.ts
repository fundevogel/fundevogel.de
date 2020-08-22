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

    forEach(container.querySelectorAll('.js-lightbox'), (lightbox: HTMLElement) => {
        let images: NodeList | {src: string, caption: string}[] = lightbox.querySelectorAll('img');

        if (template === 'about') {
            const urls = lightbox.dataset.images.split(';');
            const captions = lightbox.dataset.captions.split(';');

            let items: {src: string, caption: string}[] = [];

            forEach(urls, (url: string, index: number) => {
                items.push({
                    src: url,
                    caption: captions[index],
                })
            });

            images = items;
        }

        forEach(images, (image: HTMLImageElement) => {
            image.addEventListener('click', event => {
                BigPicture(Object.assign(options, {
                    el: event.target,
                    gallery: images,
                }));
            }, false);
        });
    });
};
