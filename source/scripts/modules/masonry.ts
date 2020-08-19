import Macy from 'macy';

import forEach from '../helpers/forEach';

function getPreset(element: HTMLElement, template: string) {
    const defaults = {
        container: element,
        trueOrder: false,
        columns: 3,
        margin: 12,
        breakAt: {
            639: 1,
            1279: 2,
        },
    };

    const presets: Record<string, any>= {
        'about.team': {
            breakAt: {
                639: 1,
                1023: 2,
            },
        },
        'calendar.single': {
            breakAt: {
                639: 2,
            },
        }
    }

    if (template === 'assortment' || template === 'assortment.single') {
        return Object.assign(defaults, {
            trueOrder: true,
            breakAt: {
                479: 1,
                639: 2,
            },
        });
    }

    return Object.assign(defaults, presets[template]);
}

export default (container: HTMLElement, template: string) => {
    forEach(container.querySelectorAll('.js-masonry'), (value: HTMLElement, index: number) => {
        const options = getPreset(value, template);

        const macy = Macy(options);
        macy.runOnImageLoad(() => {
            // @ts-ignore
            macy.recalculate(true);
        }, true);
    });
};
