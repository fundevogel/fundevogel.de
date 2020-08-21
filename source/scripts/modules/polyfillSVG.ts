import svg4everybody from 'svg4everybody';

export const polyfillSVG = (): void => svg4everybody({
    polyfill: true,
});
