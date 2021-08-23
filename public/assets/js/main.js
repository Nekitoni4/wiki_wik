import { getPageInfo } from './wiki_page.js';
import { createNewArticle, renderNewArticleRow } from "./articles_api.js";

document.querySelector('.wiki_import').addEventListener('submit', (event) => {
    event.preventDefault();
    const titlePage = document.querySelector('.wiki_import__field').value;
    const time = performance.now();
    getPageInfo(titlePage).then((articleData) => {
        const executeTime = ((performance.now() - time)/1000).toFixed(2);
        return createNewArticle(articleData);
    }).catch((err) => {
        console.log(err);
    }).then((articleData) => {
        renderNewArticleRow(articleData, '.articles tbody');
    });
});


document.querySelector('.import_articles__btn').addEventListener('click', (event) => {
    document.querySelector('.import_articles__wrapper').classList.remove('hidden');
    document.querySelector('.search_articles__wrapper').classList.add('hidden');
});

document.querySelector('.search_articles__btn').addEventListener('click', (event) => {
    document.querySelector('.search_articles__wrapper').classList.remove('hidden');
   document.querySelector('.import_articles__wrapper').classList.add('hidden');
});

