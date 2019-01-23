import { DomUtil } from '@hundh/contao-utils-bundle';

class Formhybrid {

    onReady()
    {
        this.asyncSubmit();
    }

    asyncSubmit() {
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
    }

    scrollToMessages(container) {

        if (typeof container === 'undefined') {
            container = document.querySelector('.formhybrid');
        }

        // scroll to first alert message or first error field
        let alert = container.querySelector('.alert, .error');

        if (null != alert && !container.classList.contains('noscroll')) {
            DomUtil.scrollTo(alert, 100, 500);
        }
    }

    asyncSubmitEvent(event, url = undefined) {
        event.preventDefault();
        let form = event.target;
        let formData = new FormData(form);
        formData.append('FORM_SUBMIT', form.id);

        form.querySelectorAll('input:not([disabled]), button[type="submit"]').forEach((elem) => {
            elem.disabled = true;
        });

        let request = new XMLHttpRequest();
        request.open(form.getAttribute('method'), url ? url : form.getAttribute('action'), true);
        request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

        let beforeSend = () => {
            form.classList.add('submitting');
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

                        replaceForm.dispatchEvent(new CustomEvent('formhybrid_ajax_complete', {
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
    }
}

export default Formhybrid