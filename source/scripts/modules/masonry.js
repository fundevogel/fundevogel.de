import macy from 'macy';

import forEach from '../helpers/forEach';

export default (container) => {
    forEach(container.querySelectorAll('.js-masonry'), function(value, index) {
        macy({
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
