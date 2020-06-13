/**
 * A simple forEach() implementation for Arrays, Objects and NodeLists
 * @private
 * @param {Array|Object|NodeList} collection Collection of items to iterate
 * @param {Function} callback Callback function for each iteration
 * @param {Array|Object|NodeList} scope Object/NodeList/Array that forEach is iterating over (aka `this`)
 *
 * See https://gist.github.com/cferdinandi/42f985de9af4389e7ab3
 */
export default (collection, callback, scope) => {
    if (Object.prototype.toString.call(collection) === '[object Object]') {
        for (const prop in collection) {
            if (Object.prototype.hasOwnProperty.call(collection, prop)) {
                callback.call(scope, collection[prop], prop, collection);
            }
        }
    } else {
        for (let i = 0, len = collection.length; i < len; i++) {
            callback.call(scope, collection[i], i, collection);
        }
    }
};
