import './shim-dependency.js';

import './citadel.js';

$(document).ready(function () {
    console.log("jQuery ready, initializing Select2!");

    // Inisialisasi Select2 ke semua elemen <select> yang punya class .select2
    $(".select2").select2({
        placeholder: "Pilih opsi...",
        allowClear: true
    });
});