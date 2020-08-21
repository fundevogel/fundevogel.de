export const delay = (number: number) => {
    number = number || 2000;

    return new Promise (done => {
        setTimeout(() => {
            done();
        }, number)
    });
};
