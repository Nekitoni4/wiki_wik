function validateNetwork(request, callback) {
    if (request.ok) {
        return callback();
    }
    throw new Error(`Ошибка ${request.status}: ${request.statusText}`);
}

export {validateNetwork};
