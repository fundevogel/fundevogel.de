import anime from 'animejs';

export const toggleMenu = (): void => {
    const body = document.body;
    const toggle = document.querySelector('.js-toggle');

    const timeline = anime.timeline({
        duration: 250,
        easing: 'easeInOutQuad',
    });

    if (toggle.classList.contains('is-active')) {
        timeline
            .add({
                targets: '.js-overlay .js-link',
                opacity: [1, 0],
                duration: 100,
                delay: function() {
                    return anime.random(50, 250);
                },
            })
            .add({
                targets: '.js-overlay',
                translateY: [0, '-100%'],
            }, '+=250')
            .finished.then(() => {
                body.classList.remove('overflow-hidden');
                toggle.classList.remove('is-active');
            });
    } else {
        toggle.classList.add('is-active');

        timeline
        .add({
            targets: '.js-overlay',
            translateY: ['-100%', 0],
        })
        .add({
            targets: '.js-overlay .js-link',
            opacity: [0, 1],
            duration: 100,
            delay: function() {
                return anime.random(50, 250);
            },
        })
        .finished.then(() => {
                body.classList.add('overflow-hidden');
            });
    }
};
