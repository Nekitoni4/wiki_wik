function delegate(on, callback, delegatedSelector, delegatingSelector = 'body') {
    document.querySelector(delegatingSelector).addEventListener(on, (event) => {
        document.querySelectorAll(delegatedSelector).forEach(elem => {
           if (event.target.isEqualNode(elem)) {
               callback(event);
           }
        });
    });
}

export {delegate};
