import Formhybrid from './formhybrid';

let formhybrid = new Formhybrid();

document.addEventListener('DOMContentLoaded', function() {
    formhybrid.onReady();
});

document.addEventListener('formhybrid_ajax_complete', function() {
    formhybrid.onFormhybridAjaxComplete();
});

document.addEventListener('huh.list.modal_show', (event) => {
    event.detail.modalElement.addEventListener('shown.bs.modal', (shownEvent) => {
        formhybrid.onFormhybridAjaxComplete(shownEvent.target);
    });
});