// @ts-ignore
import BigPicture from 'bigpicture';

import forEach from '../helpers/forEach';

export default (container: HTMLElement) => {
    forEach(container.querySelectorAll('.js-lightbox'), (value: HTMLElement, index: number) => {
        value.addEventListener('click', (element) => {
            BigPicture({
                // @ts-ignore
                el: element.target,
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
            });
        }, false);
    });
};
