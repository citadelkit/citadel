import $ from 'jquery';

// Buat jQuery global, agar plugin jQuery lama bisa akses
window.$ = $;
window.jQuery = $;

console.log("window $?",window.$)

import bootstrap from "bootstrap/dist/js/bootstrap.bundle.min.js";

window.bootstrap = bootstrap


$('.dropdown-toggle').on('show.bs.dropdown', function() {
    alert("EVENT SHOW DROPDOWN")
})