import { $, jQuery } from './shim-jquery'

import 'jquery-slimscroll/jquery.slimscroll.min.js';
import 'jquery-loading-overlay';
import 'prismjs/prism.js';
import 'apexcharts/dist/apexcharts.min.js';
import 'dropzone';
import 'prismjs/plugins/toolbar/prism-toolbar.min.js';
import 'prismjs/plugins/copy-to-clipboard/prism-copy-to-clipboard.min.js';
import '@support/dash-ui/src/assets/js/main.js';
import '@support/dash-ui/src/assets/js/feather.js';
import '@support/dash-ui/src/assets/js/sidebarMenu.js';

import 'autonumeric';
import 'summernote';
import toastr from 'toastr';
import Inputmask from 'inputmask';
import Swal from 'sweetalert2';
import Select2 from 'select2';
jQuery.fn.inputmask = function (maskOrAlias, opts) {
    return this.each(function () {
        const im = new Inputmask(maskOrAlias, opts);
        im.mask(this);  
    });
};
jQuery.fn.select2 = function (opts) {
    return this.each(function () {
        new Select2(this, opts);
    });
};

jQuery.loadingOverlay = () => {
    console.log("Use $('.body').loadingOverlay()")
}

window.$ = jQuery;
window.jQuery = jQuery;
window.jquery = jQuery;
window.Swal = Swal
window.swal = Swal
window.toastr = toastr
