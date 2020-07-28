// See https://gist.github.com/cferdinandi/42f985de9af4389e7ab3

export default (
    collection: (string | number)[] | Object | NodeList,
    callback: Function,
    scope?: (string | number)[] | Object | NodeList
): void => {
    if (Object.prototype.toString.call(collection) === '[object Object]') {
        for (const prop in collection) {
            if (Object.prototype.hasOwnProperty.call(collection, prop)) {
                // @ts-ignore
                callback.call(scope, collection[prop], prop, collection);
            }
        }
    } else {
        // @ts-ignore
        for (let index = 0; index < collection.length; index++) {
            // @ts-ignore
            callback.call(scope, collection[index], index, collection);
        }
    }
};
