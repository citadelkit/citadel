import jQuery from 'jquery';
// import 'jquery-migrate';

// Make jQuery global
window.$ = window.jQuery = jQuery;

// Select2
import select2 from 'select2';
import 'select2/dist/css/select2.min.css';
select2(jQuery);

// Pace
import "pace-js";

// Bootstrap (bundle includes Popper)
import bootstrap from "bootstrap/dist/js/bootstrap.bundle.min.js";
window.bootstrap = bootstrap;

console.log('jQuery loaded:', window.jQuery.fn.jquery);

export default jQuery;