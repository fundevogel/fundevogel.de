import {forEach} from '../helpers/forEach';

export const runCharts = (container: HTMLElement) => {
    forEach(container.querySelectorAll('.js-label'), (value: HTMLElement) => {
        value.style.background = value.dataset.color;
    });
};
