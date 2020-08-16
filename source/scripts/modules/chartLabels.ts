import forEach from '../helpers/forEach';

export default (container: HTMLElement) => {
    forEach(container.querySelectorAll('.js-label'), (value: HTMLElement, index: number) => {
        const color = value.dataset.color;

        // @ts-ignore
        value.style = 'background:' + color;
    });

};
