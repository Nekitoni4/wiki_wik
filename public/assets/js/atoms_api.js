import {onServe} from "./helpers/serve.js";

async function getArticlesByAtom(atom) {
    const targetUrl = `http://localhost:8000/api/search?atom=${atom.toLowerCase()}`;
    return onServe(targetUrl);
}

async function getArticleById(id) {
    const targetUrl = `http://localhost:8000/api/search/${id}`;
    return onServe(targetUrl);
}


function getCoincidencesNumber(searchArticles) {
    return searchArticles.length;
}

function renderCoincidencesNumber(searchArticles, containerSelector) {
    document.querySelector(containerSelector).textContent = getCoincidencesNumber(searchArticles);
}

function renderSearchRows(searchArticles, containerSelector) {
    const targetContainer = document.querySelector(containerSelector);
    targetContainer.innerHTML = '';
    searchArticles.forEach((article) => {
        targetContainer.insertAdjacentHTML('beforeend', renderSearchRow(article));
    });
}

function renderSearchRow(searchArticle) {
    const {title, id} = searchArticle;
    const occurences = searchArticle['pivot']['occurrences'];
    const template = `
        <li><a href="#" data-id="${id}">${title}</a>(${occurences} вхождений)</li>
    `;
    return template;
}



export {getArticlesByAtom, renderSearchRows, renderCoincidencesNumber};
