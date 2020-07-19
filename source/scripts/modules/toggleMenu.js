import anime from 'animejs';

export default () => {
    const body = document.body;
    const toggle = document.querySelector('.js-toggle');
    const isOpen = toggle.classList.contains('is-active');

    const timeline = anime.timeline({
        duration: 250,
        easing: 'easeInOutQuad',
    });

    if (isOpen) {
        timeline
            .add({
                targets: '.js-overlay .js-link',
                opacity: 0,
                duration: 50,
                delay: function() {
                    return anime.random(0, 250);
                },
            })
            .add({
                targets: '.js-overlay',
                translateY: '-100%',
            }, '+=150')
            .finished.then(() => {
                toggle.classList.remove('is-active');
            });

        body.classList.remove('overflow-hidden');
    } else {
        toggle.classList.add('is-active');

        timeline
            .add({
                targets: '.js-overlay',
                translateY: 0,
            })
            .add({
                targets: '.js-overlay .js-link',
                opacity: 1,
                duration: 50,
                delay: function() {
                    return anime.random(0, 250);
                },
            })
            .finished.then(() => {
                body.classList.add('overflow-hidden');
            });
    }
};
