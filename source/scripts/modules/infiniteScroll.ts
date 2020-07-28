// @ts-ignore
import InfiniteScroll from 'infinite-scroll';

export default (container: HTMLElement) => {
    return new InfiniteScroll(container.querySelector('.js-list'), {
        hideNav: '.js-hide',
        button: '.js-more',
        path: '.js-target',
        append: '.js-article',
        scrollThreshold: 750,
        history: false,
    });
};
