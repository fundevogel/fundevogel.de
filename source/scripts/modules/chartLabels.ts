import {forEach} from '../helpers/forEach';

export const runCharts = (container: HTMLElement) => {
    forEach(container.querySelectorAll('.js-label'), (value: HTMLElement, index: number) => {
        // @ts-ignore
        value.style = 'background:' + value.dataset.color;
    });
};
