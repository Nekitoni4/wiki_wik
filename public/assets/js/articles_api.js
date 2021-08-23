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

function renderNewArticleRow(articleData, containerSelector) {
    const {title, url, size, count_words} = articleData;
    const html = `
        <tr>
            <td>${title}</td>
            <td>${url}</td>
            <td>${size}kb</td>
            <td>${count_words}</td>
        </tr>
    `;
    document.querySelector(containerSelector).insertAdjacentHTML('beforeend', html);
}

export {createNewArticle, renderNewArticleRow};
