import BigPicture from 'bigpicture';

import forEach from '../helpers/forEach';

export default (container) => {
    forEach(container.querySelectorAll('.js-lightbox'), function(value, index) {
        value.addEventListener('click', function(element) {
            // eslint-disable-next-line new-cap
            BigPicture({
                el: element.target,
                gallery: value.querySelectorAll('img'),
                loop: true,

                // Prevent scrollbar overflow
                animationStart: function() {
                    document.documentElement.style.overflowY = 'hidden';
                    document.body.style.overflowY = 'scroll';
                },
                onClose: function() {
                    document.documentElement.style.overflowY = 'auto';
                    document.body.style.overflowY = 'auto';
                },
            });
        }, false);
    });
};
