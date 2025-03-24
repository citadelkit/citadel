


window.detailFormatter = function (index, row, url) {
    var mydata = $.getCustomJSON("admin/dashboard");

    var html = [];
    $.each(row, function (key, value) {
        var data = $.grep(mydata, function (e) {
            return e.field == key;
        });

        if (typeof data[0] !== 'undefined') {

            html.push('<p><b>' + data[0].alias + ':</b> ' + value + '</p>');
        }
    });

    return html.join('');

}

window.operateFormatter = function (value, row, index) {
    var link = "<?php echo url('administration/master_data/divisi_departemen'); ?>";
    return [
        '<div class = "btn-group"> <a class="btn btn-sm btn-info btn-xs action" href="' +
        link + '/ubah/' + value + '">', '<i class="ft-edit mr-1"></i>Ubah', '</a>  ',
        '<a class="btn btn-sm btn-danger btn-xs action" onclick="return confirm(\'Anda yakin ingin menonaktifkan data?\')" href="' +
        link + '/nonaktif/' + value + '">', '<i class="ft-power mr-1"></i>Nonaktif',
        '</a> </div> ',
    ].join('');
}

window.totalTextFormatter = function (data) {
    return 'Total';
}

window.totalNameFormatter = function (data) {
    return data.length;
}

window.totalPriceFormatter = function (data) {
    var total = 0;
    $.each(data, function (i, row) {
        total += +(row.price.substring(1));
    });
    return '$' + total;
}

window.formatCurrency = function (value) {
    return number_format(value, 0, ',', '.'); // Adjusted to use three decimal places
}

window.formatVolume = function (value) {
    return number_format(value, 3, ',', '.'); // Adjusted to use three decimal places
}


window.toggleFloaters = function (event) {
    event.preventDefault()
    const $target = $(event.target)
    const $blueprint = $($target.data('blueprint'))
    const $container = $($target.data('container'))

    $container.toggleClass('col-md-4 d-md-none')
    $blueprint.toggleClass('col-md-8 col-md-12')
    $target.toggleClass('btn-show-floaters btn-hide-floaters')
    $target.toggleClass('btn-info btn-danger')
    if ($target.hasClass('btn-info')) {
        $target.children('.icon').addClass('ft-arrow-left-circle')
        $target.children('.icon').removeClass('ft-arrow-right-circle')
    }
    if ($target.hasClass('btn-danger')) {
        $target.children('.icon').addClass('ft-arrow-right-circle')
        $target.children('.icon').removeClass('ft-arrow-left-circle')
    }
}
