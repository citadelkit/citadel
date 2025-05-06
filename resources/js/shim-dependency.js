import { $ } from './shim-jquery'

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
import Inputmask from 'inputmask';
$.fn.inputmask = function (maskOrAlias, opts) {
    return this.each(function () {
        const im = new Inputmask(maskOrAlias, opts);
        im.mask(this);  
    });
};

window.$ = $;
window.jQuery = $;
window.jquery = $;

console.log("INPUTMASK", $.fn.inputmask)