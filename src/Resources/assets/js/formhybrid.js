import { DomUtil } from '@hundh/contao-utils-bundle';

class Formhybrid {

    onReady()
    {
        this.asyncSubmit();
        this.onChangeSubmit();
        this.scrollToMessages();
    }

    onFormhybridAjaxComplete(parent = document)
    {
        this.asyncSubmit(parent);
        this.onChangeSubmit(parent);
    }

    asyncSubmit(parent = document)
    {
        let self = this;

        parent.querySelectorAll('.formhybrid form[data-async]').forEach( element => {
            element.addEventListener('submit', event => {
                event.preventDefault();
                self.asyncSubmitEvent(event.target);
            });
        });
    }

    onChangeSubmit(parent = document)
    {
        let inputs = parent.querySelectorAll('.formhybrid form input[data-submit-on-change], .formhybrid form select[data-submit-on-change]');
        if (inputs.length < 1 ) {
            return;
        }
        inputs.forEach((input, index) => {
            if ("1" !== input.dataset.submitOnChange) {
                return;
            }
            input.addEventListener('change', (event) => {
                let action = event.target.form.getAttribute('action');
                let url = new URL(action);
                url.searchParams.append('as', 'ajax');
                url.searchParams.append('ag', 'formhybrid');
                url.searchParams.append('aa', 'reload');
                this.asyncSubmitEvent(event.target.form, url.toString());
            });

        });
    }

    scrollToMessages(container) {
        if (typeof container === 'undefined' || container == null) {
            container = document.querySelector('.formhybrid');
            if (container === null) {
                return;
            }
        }

        // scroll to first alert message or first error field
        let alert = container.querySelector('.alert, .error');

        if (null != alert && !container.classList.contains('noscroll')) {
            let focusable = container.querySelector('input.error:not([tabindex="-1"]), select.error:not([tabindex="-1"]), textarea.error:not([tabindex="-1"])');

            DomUtil.scrollTo(alert, 100, 500, true);

            if (null !== focusable) {
                focusable.focus();
            }
        }
    }

    asyncSubmitEvent(form, url = undefined) {

        let formData = new FormData(form);
        let self = this;
        formData.append('FORM_SUBMIT', form.id);

        form.querySelectorAll('input:not([disabled]), button[type="submit"], select, textarea').forEach((elem) => {
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
                                detail: response.result.data
                            }
                        ));

                        self.scrollToMessages(replaceForm);

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
            }
        };

        beforeSend();
        request.send(formData);
    }
}

export default Formhybrid