

function Formhybrid() {
}

Formhybrid.prototype.onReady = function() {
    this.asyncSubmit();
};

Formhybrid.prototype.asyncSubmit = function() {
    // if (typeof form !== 'undefined') {
    //     var $form = $(form);
    //     if ($form.length > 0) {
    //         FormhybridAjaxRequest._asyncFormSubmit($form);
    //     }
    //     return false;
    // }

    document.querySelectorAll('.formhybrid form[data-async]').forEach((element) => {
        element.addEventListener('submit', this.asyncSubmitEvent.bind(this));
    });
};

Formhybrid.prototype.scrollToMessages = function(container) {

    if (typeof container === 'undefined') {
        container = document.querySelector('.formhybrid');
    }

    // scroll to first alert message or first error field
    let alert = container.querySelector('.alert, .error');

    if (null != alert && !container.classList.contains('noscroll')) {

        import(/* webpackChunkName: "contao-utils-bundle" */ 'contao-utils-bundle').then((UtilsBundle) => {
                UtilsBundle.dom.scrollTo(alert, 100, 500);
            },
        );
    }
};

Formhybrid.prototype.asyncSubmitEvent = function(event, url = undefined) {
    event.preventDefault();
    let form = event.target;
    let formData = new FormData(form);
    formData.append('FORM_SUBMIT', form.id);

    let submit = form.querySelector('[type=submit]');

    form.querySelectorAll('input:not([disabled])').forEach((elem) => {
        elem.disabled = true;
    });

    // if (typeof data != "undefined") {
    //     $formData.push(data);
    // }

    let submitText = submit;
    if (submit.matches('button')) {
        if (submit.children.length > 0) {
            let submitChilds = submit.children;
            if (submitChilds.length > 0) {
                submitText = submitChilds.item(0);
            }
        }
    }

    let request = new XMLHttpRequest();
    request.open(form.getAttribute('method'), url ? url : form.getAttribute('action'), true);
    request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

    let beforeSend = function() {
        let i = 1;
        let text = submitText.textContent;
        console.log('Before:', text);
        setInterval(() => {
            submitText.textContent = text + Array((++i % 4) + 1).join('.');
        });
    };
    request.onreadystatechange = function() {
        const DONE = 4;
        const OK = 200;

        if (request.readyState === DONE) {
            if (request.status === OK) {
                let response = JSON.parse(request.response);

                if (response.result.html && response.result.data.id) {

                    let container = document.createElement('div');
                    container.innerHTML = response.result.html;
                    let replaceForm = container.querySelector('#' + response.result.data.id);

                    if (typeof replaceForm !== 'undefined') {
                        form.replaceWith(replaceForm);
                    }

                    // run embedded js code (example contao captcha field)
                    replaceForm.querySelectorAll('script').forEach(script => {
                        try {
                            eval(script.innerHTML || script.innerText);
                        } catch (e) {

                        }
                    });

                    replaceForm.dispatchEvent(new Event('formhybrid_ajax_complete', {
                        bubbles: true,
                    }));

                    this.scrollToMessages(replaceForm);

                    // closeModal(response, $form);
                }
            }
        }
    }.bind(this);
    request.onerror = function() {
        if (request.status === 300) {
            let url = JSON.parse(request.responseText).result.data.url;

            location.href = url.charAt(0) === '/' ? url : '/' + url;
            // closeModal(jqXHR.responseJSON, $form);
            return;
        }
    };

    beforeSend();
    request.send(formData);
};

module.exports = Formhybrid;

let formhybridAjax = new Formhybrid();

document.addEventListener('DOMContentLoaded', function() {
    formhybridAjax.onReady();
});

document.addEventListener('formhybrid_ajax_complete', function() {
    formhybridAjax.onReady();
});
