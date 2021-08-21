import {validateNetwork} from "./network_helpers.js";

async function createNewArticle(articleData) {
    const targetUrl = 'http://localhost:8000/api/articles';
    const request = await fetch(targetUrl, {
       method: 'POST',
        headers: {
           'Content-Type': 'application/json'
        },
       body: JSON.stringify(articleData)
    });
    return validateNetwork(request, async () => {
       return request.json();
    });
}

export {createNewArticle};
