// See https://gist.github.com/cferdinandi/42f985de9af4389e7ab3

export default (collection, callback, scope) => {
    if (Object.prototype.toString.call(collection) === '[object Object]') {
        for (const prop in collection) {
            if (Object.prototype.hasOwnProperty.call(collection, prop)) {
                callback.call(scope, collection[prop], prop, collection);
            }
        }
    } else {
        for (let index = 0, len = collection.length; index < len; index++) {
            callback.call(scope, collection[index], index, collection);
        }
    }
};
