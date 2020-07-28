// @ts-ignore
import Dropkick from 'dropkickjs';

import forEach from '../helpers/forEach';

export default (container: HTMLElement) => {
    forEach(container.querySelectorAll('.js-select'), (value: HTMLElement, index: number) => {
        value.onchange = () => {
            // @ts-ignore
            window.location.href = this.value;
        };

        new Dropkick(value);
    });
};
