import { Donut } from '@verivox/tiny-donuts';

import forEach from '../helpers/forEach';

export default (container: HTMLElement) => {
    forEach(container.querySelectorAll('.js-chart'), (value: HTMLElement, index: number) => {
        // Get information about languages from chart element's data attributes
        const colors = value.dataset.colors.split(' ');
        const percentages = value.dataset.percentages.split(' ');

        // Generate the `entries` array
        let entries = [];

        for (let index = 0; index < colors.length; index++){
           entries.push({
               color: colors[index],
               value: percentages[index],
            });
        }

        // Define the chart object
        const chart = new Donut({
            // @ts-ignore
            entries: entries,
            thickness: 15,
            spacing: 0.005,
        })

        // Create the SVG element ..
        const svg = chart.getSVGElement();

        // .. and append it to the chart element
        value.appendChild(svg);
    });

    forEach(container.querySelectorAll('.js-label'), (value: HTMLElement, index: number) => {
        const color = value.dataset.color;
        console.log(color);
        // @ts-ignore
        value.style = 'background:' + color;
    });
};
