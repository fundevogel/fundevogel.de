import {tns as tinySlider} from 'tiny-slider/src/tiny-slider.module';

import forEach from '../helpers/forEach';
import getClosest from '../helpers/getClosest';

function getPreset(element, template) {
    const defaults = {
        container: element,
        speed: 2500,
        autoplay: true,
        autoplayTimeout: template === 'about' ? 3500 : 5000,
        autoplayHoverPause: true,
        autoplayButtonOutput: false,
        controls: false,
        nav: false,
    };

    const presets = {
        'about': {
            speed: 1000,
            mode: 'gallery',
        },
        'calendar.single': {
            items: 2,
            slideBy: 1,
            responsive: {
                1024: {
                    items: 3,
                    slideBy: 2,
                },
                1280: {
                    items: 4,
                    slideBy: 3,
                },
            },
            edgePadding: 40,
            center: true,
        },
    };

    // Common preset for 'assortment.single' & 'lesetipps.article'
    if (template === 'assortment.single' || template === 'lesetipps.article') {
        return Object.assign(defaults, {
            speed: 1500,
            nav: true,
            navContainer: getClosest(element, '.wave').querySelector('.js-controls'),
        });
    }

    return Object.assign(defaults, presets[template]);
}

export default (container, template) => {
    forEach(container.querySelectorAll('.js-slider'), function(value, index) {
        const options = getPreset(value, template);

        tinySlider(options);
    });
};
