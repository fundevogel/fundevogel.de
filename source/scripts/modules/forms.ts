// @ts-ignore
import Dropkick from 'dropkickjs';

import {forEach} from '../helpers/forEach';

export const runForms = (container: HTMLElement) => {
    forEach(container.querySelectorAll('.js-select'), (select: HTMLSelectElement) => {
        select.onchange = event => {
            const target = <HTMLSelectElement>event.target;
            window.location.href = target.value;
        };

        new Dropkick(select);
    });
};
