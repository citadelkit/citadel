import jQuery from 'jquery';
// import 'jquery-migrate';

import select2 from 'select2';
import 'select2/dist/css/select2.min.css';

select2(jQuery);
window.$ = window.jQuery = jQuery

console.log(window.jQuery, window.$)

import "pace-js";


import bootstrap from "bootstrap/dist/js/bootstrap.bundle.min.js";
window.bootstrap = bootstrap;

console.log('jQuery.event.global:', jQuery.event.global); // should be an object, not undefined

export default jQuery;
