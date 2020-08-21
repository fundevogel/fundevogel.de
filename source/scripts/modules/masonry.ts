import Macy from 'macy';

import {forEach} from '../helpers/forEach';

const getPreset = (element: HTMLElement, template: string) => {
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
        },
        'lesetipps.archive': {
            trueOrder: true,
            columns: 4,
            margin: 24,
            breakAt: {
                479: 2,
                1023: 3,
            },
        },
    };

    if (template === 'assortment' || template === 'assortment.single') {
        return Object.assign(defaults, {
            trueOrder: true,
            breakAt: {
                479: 1,
                767: 2,
            },
        });
    }

    return Object.assign(defaults, presets[template]);
}

export const runMasonry = (container: HTMLElement, template: string) => {
    forEach(container.querySelectorAll('.js-masonry'), (value: HTMLElement, index: number) => {
        const options = getPreset(value, template);

        const macy = Macy(options);
        macy.runOnImageLoad(() => {
            // @ts-ignore
            macy.recalculate(true);
        }, true);
    });
};
