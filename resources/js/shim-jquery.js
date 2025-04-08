import $ from 'jquery';

// Buat jQuery global, agar plugin jQuery lama bisa akses
window.$ = $;
window.jQuery = $;

console.log("window $?",window.$)