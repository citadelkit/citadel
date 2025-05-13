// setup-legacy-globals.js

import './shim-jquery.js';

import 'jquery-slimscroll';
import 'jquery-loading-overlay';
import 'dropzone';
import 'summernote';
import 'select2';

// Bind plugins to jQuery
import Inputmask from 'inputmask';
import toastr from 'toastr';
import Swal from 'sweetalert2';


window.Swal = Swal;
window.swal = Swal;
window.toastr = toastr;

jQuery.fn.inputmask = function (maskOrAlias, opts) {
  return this.each(function () {
    const im = new Inputmask(maskOrAlias, opts);
    im.mask(this);
  });
};

jQuery.loadingOverlay = () => {
  console.log("Use $('.body').loadingOverlay()");
};


import 'apexcharts';
import 'prismjs/prism.js';
import 'prismjs/plugins/toolbar/prism-toolbar.min.js';
import 'prismjs/plugins/copy-to-clipboard/prism-copy-to-clipboard.min.js';

import '@support/dash-ui/src/assets/js/main.js';
import '@support/dash-ui/src/assets/js/feather.js';
import '@support/dash-ui/src/assets/js/sidebarMenu.js';