export const jsDetect = (): void => {
    let html;
    let className;

    html = document.documentElement;
    className = html.className.replace('no-js', 'js');
    html.className = className;
};
