// See https://gist.github.com/Dobby89/ba967b77fe2da5f4f596c6337c78fb52

export default (target, selector, scope) => {
    const matches = (scope || document).querySelectorAll(selector);
    let element = target;
    let index;

    do {
        index = matches.length;
        while (--index >= 0 && matches.item(index) !== element) {/**/}
    } while ((index < 0) && (element = element.parentElement));

    return element;
};
