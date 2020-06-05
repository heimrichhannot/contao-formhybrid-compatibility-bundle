import Formhybrid from './formhybrid';

let formhybrid = new Formhybrid();

document.addEventListener('DOMContentLoaded', function() {
    formhybrid.onReady();
});

document.addEventListener('formhybrid_ajax_complete', function() {
    formhybrid.onFormhybridAjaxComplete();
});