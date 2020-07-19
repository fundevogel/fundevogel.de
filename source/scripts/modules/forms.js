import Dropkick from 'dropkickjs';

import forEach from '../helpers/forEach';

export default (container) => {
    forEach(container.querySelectorAll('.js-select'), function(value, index) {
        value.onchange = function() {
            // if (this.selectedIndex !== 0) {
            window.location.href = this.value;
            // }
        };

        new Dropkick(value);
    });
};
