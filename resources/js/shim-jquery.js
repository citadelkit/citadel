import $ from 'jquery';

// Buat jQuery global, agar plugin jQuery lama bisa akses
window.$ = $;
window.jQuery = $;
window.jquery = $;

console.log("window $?",window.$)

import bootstrap from "bootstrap/dist/js/bootstrap.bundle.min.js";

window.bootstrap = bootstrap


// Jquery Library
import "pace-js";
import "select2";
import "select2/dist/css/select2.min.css"; // Import CSS Select2

