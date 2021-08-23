// Функция-помощник для упрощения отправки запроса
async function onServe(URL, typeRequest = 'GET', targetObject = null) {
    const requestResponse = await fetch(URL, {
        method: typeRequest,
        [typeRequest.toUpperCase() === 'POST' ||
        typeRequest.toUpperCase() === 'PATCH' ? 'body' : ''] : targetObject ? JSON.stringify(targetObject) : '',
    });
    if (requestResponse.ok) {
        return requestResponse.json();
    } else {
        throw requestResponse;
    }
}

export {onServe};
