import Macy from 'macy';

import forEach from '../helpers/forEach';

export default (container: HTMLElement) => {
    forEach(container.querySelectorAll('.js-masonry'), (value: HTMLElement, index: number) => {
        Macy({
            container: value,
            trueOrder: false,
            columns: 3,
            margin: 16,
            breakAt: {
                767: 1,
                1279: 2,
            },
        });
    });
};
