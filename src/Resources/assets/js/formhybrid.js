import { DomUtil } from '@hundh/contao-utils-bundle';
import { EventUtil } from '@hundh/contao-utils-bundle';

class Formhybrid {

    onReady()
    {
        this.asyncSubmit();
        this.onchangeSubmit();
        this.scrollToMessages();
    }

    onFormhybridAjaxComplete()
    {
        this.asyncSubmit();
    }

    asyncSubmit() {
        let self = this;

        EventUtil.addDynamicEventListener('submit','.formhybrid form[data-async]', function(el, event) {
            self.asyncSubmitEvent(event.target);
            event.preventDefault();
        });
    }

    onchangeSubmit() {
        let self = this;

        let selectWithOnchange = document.querySelectorAll('.formhybrid form select[onchange]');
        selectWithOnchange.forEach(function(element) {
            element.onchange = ""
        })

        EventUtil.addDynamicEventListener('change','.formhybrid form select[onchange]', function(el, event) {
            self.onchangeSubmitEvent(event);
            event.preventDefault();
        });
    }

    onchangeSubmitEvent(event, url = undefined) {
        let self = this;
        let forms = document.querySelectorAll('.formhybrid form');
        let form = undefined;
        forms.forEach((element) => {
            if(element.contains(event.target)) {
                form = element;
            }
        })

        if (typeof form === 'undefined') {
            return;
        }

        let test = window.location;
        url = window.location.pathname + '?as=ajax&ag=formhybrid&aa=reload'
        console.log(url);
        self.asyncSubmitEvent(form, url);
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