// See https://stackoverflow.com/a/237176

export default (array, object) => {
    let index = array.length;

    while (index--) {
        if (array[index] === object) {
            return true;
        }
    }

    return false;
};
