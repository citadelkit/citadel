// setup-legacy-globals.js

import jQuery from './shim-jquery.js';

// Ensure all plugins patch THIS jQuery
import 'jquery-slimscroll';  
import 'dropzone';
import 'summernote';
import 'jquery-loading-overlay';

// Bind plugins to jQuery
import Inputmask from 'inputmask';
import toastr from 'toastr';
import Swal from 'sweetalert2';

window.Swal = Swal;
window.swal = Swal;
window.toastr = toastr;

// Attach Inputmask
jQuery.fn.inputmask = function (maskOrAlias, opts) {
  return this.each(function () {
    const im = new Inputmask(maskOrAlias, opts);
    im.mask(this);
  });
};


import 'apexcharts';
// import 'prismjs/prism.js';
// import 'prismjs/plugins/toolbar/prism-toolbar.min.js';
// import 'prismjs/plugins/copy-to-clipboard/prism-copy-to-clipboard.min.js';

import "@support/dash-ui/src/assets/css/theme.css";
import '@support/dash-ui/src/assets/js/main.js';
import '@support/dash-ui/src/assets/js/feather.js';
import '@support/dash-ui/src/assets/js/sidebarMenu.js';