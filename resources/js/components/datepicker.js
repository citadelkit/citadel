export default function CitadelDatepicker(element) {
    const $picker = $(element)
    const config = $picker.attr('citadel-datepicker') ? JSON.parse($picker.attr('citadel-datepicker')) : {};
    $picker.datepicker({
        ...config
    })
}
