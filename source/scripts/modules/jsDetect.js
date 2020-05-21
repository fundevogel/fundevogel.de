export default () => {
    let className = '';
    let html = '';
    html = document.documentElement;
    className = html.className.replace('no-js', 'js');
    html.className = className;
};
