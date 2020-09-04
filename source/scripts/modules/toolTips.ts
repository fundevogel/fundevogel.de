import tippy, {createSingleton, roundArrow} from 'tippy.js';

export const runTooltips = (container: HTMLElement): void => {
    tippy(container.querySelectorAll('.js-tippy'), {
        theme: 'fundevogel orange',
        duration: [350, 150],
        offset: [0, 20],
        arrow: roundArrow,
        plugins: [],

        // Use `title` attribute as content
        content(reference) {
            const title = reference.getAttribute('title');
            reference.removeAttribute('title');
            return title;
        },
    });
};

export const activateMainMenu = (container: HTMLElement): void => {
    const instances = tippy(container.querySelectorAll('.js-singleton'), {
        theme: 'fundevogel orange',
        duration: [350, 150],
        offset: [0, 20],
        arrow: roundArrow,
        plugins: [],

        // Use template-specific template as content
        content(reference: HTMLElement) {
            const title = reference.getAttribute('title');
            reference.removeAttribute('title');

            const id = reference.getAttribute('data-template');
            if (id === 'js-undefined') {
                return title;
            }

            const template = document.getElementById(id);
            template.classList.remove('hidden');

            return template;
        },
    });

    createSingleton(instances, {
        theme: 'menu',
        maxWidth: 450,
        duration: [500, 350],
        offset: [0, 20],
        arrow: roundArrow,
        allowHTML: true,
        delay: 1000,
        appendTo: () => container,
        moveTransition: 'transform 350ms ease-out',
        // Only on dev
        // hideOnClick: false,
        // trigger: 'click',

        // Interactive tooltip, closing range + time
        interactive: true,
        interactiveBorder: 30,
        interactiveDebounce: 75,
    });
}
