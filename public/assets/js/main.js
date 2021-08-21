import { getPageInfo } from './wiki_page.js';
import { createNewArticle } from "./articles_api.js";

document.querySelector('.wiki_import').addEventListener('submit', (event) => {
    event.preventDefault();
    const titlePage = document.querySelector('.wiki_import__field').value;
    const time = performance.now();
    getPageInfo(titlePage).then((articleData) => {
        const executeTime = ((performance.now() - time)/1000).toFixed(2);
        return createNewArticle(articleData);
    }).catch((err) => {
        console.log(err);
    }).then((body) => {
        console.log(body);
    });
});


