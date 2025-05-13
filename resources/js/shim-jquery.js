import jQuery from 'jquery';
import "select2/dist/css/select2.min.css"; // Import CSS Select2
import "pace-js";
import datepickerFactory from "jquery-datepicker";
datepickerFactory(jQuery)
import bootstrap from "bootstrap/dist/js/bootstrap.bundle.min.js";

window.bootstrap = bootstrap

const $ = jQuery
window.$ = jQuery;
window.jQuery = jQuery;
window.jquery = jQuery;

export { jQuery, $ }