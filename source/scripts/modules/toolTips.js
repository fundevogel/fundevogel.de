import tippy, {roundArrow} from 'tippy.js';

export default (container) => {
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
