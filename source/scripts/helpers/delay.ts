export const delay = (number: number) => {
    number = number || 2000;

    return new Promise<void> (done => {
        setTimeout(() => {
            done();
        }, number)
    });
};
