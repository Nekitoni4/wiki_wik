import {onServe} from "./helpers/serve.js";

async function createNewArticle(articleData) {
    const targetUrl = 'http://localhost:8000/api/articles';
    return onServe(targetUrl, 'POST', articleData);
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
