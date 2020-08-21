// @ts-ignore
import Dropkick from 'dropkickjs';

import {forEach} from '../helpers/forEach';

export const runForms = (container: HTMLElement) => {
    forEach(container.querySelectorAll('.js-select'), (value: HTMLElement, index: number) => {
        value.onchange = event => {
            // @ts-ignore
            window.location.href = event.target.value;
        };

        new Dropkick(value);
    });
};
