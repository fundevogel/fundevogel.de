import Macy from 'macy';

import forEach from '../helpers/forEach';

function getPreset(element: HTMLElement, template: string) {
    const defaults = {
        container: element,
        trueOrder: false,
        columns: 3,
        margin: 16,
        breakAt: {
            639: 1,
            1279: 2,
        },
    };

    if (template === 'about.team') {
        return Object.assign(defaults, {
            breakAt: {
                639: 1,
                1023: 2,
            },
        });
    }

    return Object.assign(defaults);
}

export default (container: HTMLElement, template: string) => {
    forEach(container.querySelectorAll('.js-masonry'), (value: HTMLElement, index: number) => {
        const options = getPreset(value, template);

        Macy(options);
    });
};
