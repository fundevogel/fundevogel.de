// See https://gist.github.com/Dobby89/ba967b77fe2da5f4f596c6337c78fb52

export default (
	target: HTMLElement,
	selector: string,
	scope?: HTMLElement
): null | HTMLElement => {
	const matches = (scope || document).querySelectorAll(selector);
	let index;
	let element: null | HTMLElement = target;

	do {
		index = matches.length;
		while (--index >= 0 && matches.item(index) !== element) {}
    } while (index < 0 && (element = element.parentElement ? element.parentElement : null));

	return element;
}
