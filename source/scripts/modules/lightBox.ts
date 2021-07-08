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
        const images = lightbox.querySelectorAll('img');

        // Fill items ..
        let items: {src: string, caption: string}[] | NodeListOf<HTMLImageElement> = [];

        if (template === 'about' || template === 'assortment') {
            // .. with data from lightbox element
            const urls = lightbox.dataset.images.split(';');
            const captions = lightbox.dataset.captions.split(';');

            forEach(urls, (url: string, index: number) => {
                (<{src: string, caption: string}[]>items).push({
                    src: url,
                    caption: captions[index],
                })
            });
        } else {
            // .. or lightbox images themselves
            items = images;
        }

        forEach(images, (image: HTMLImageElement) => {
            image.addEventListener('click', event => {
                BigPicture(Object.assign(options, {
                    el: event.target,
                    gallery: items,
                }));
            }, false);
        });
    });
};
