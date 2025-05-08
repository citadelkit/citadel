export default function formSubmit(form_target, after_submit, getPlugins) {
    const $form = $(form_target)

    // console.log("ARGS ",$form, this.args)

    const data = serializeFormData($form.serializeArray())

    let url = $form.attr('action')
    let method = $form.attr('method')
    if (window.main_form_data) {
        data.raw = {
            ...window.main_form_data
        }
    }


    // console.log($form, data);
    Pace.track(function () {
        $form.find('input, button[type="submit"]').prop('disabled', true);
        submitFormAction(url, method, data, { citadel: { sweet_alert: { after_confirm: after_submit } } }, getPlugins)
        // $form.find('input, button').prop('disabled', false)
        $form.find('input, button[type="submit"]').prop('disabled', false);
    })
}


export function submitFormAction(url, method, data, config = {}, getPlugins) {
    let headers = {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
            'content'),
        'Content-Type': config.contentType ?? "application/json",
        'x-request-via': "citadel-form-wrapped"
    }
    // alert("Method" + method)
    $.LoadingOverlay()
    return $.ajax({
        url: url,
        headers: headers,
        type: method,
        data: JSON.stringify(data),
        success: function (json) {
            $.LoadingOverlay("remove");
            if (json.swal) {
                Swal.fire(json.swal).then(() => {
                    if (json.swal.redirectUrl) {
                        window.location.href = json.swal
                            .redirectUrl
                    }
                })
                return json
            }
            if (json.citadel) {
                getPlugins(json.citadel).set(config.citadel).init()
            } else if (json.status == "success") {
                Swal.fire(config.swalSuccessMessage)
            } else {
                if (config.swalErrorMessage) {
                    Swal.fire(config.swalErrorMessage)
                } else {
                    Swal.fire({
                        type: 'error',
                        html: json.error_message,
                    })
                }
            }
            return json
        },
        error: function (res) {
            const json = res.responseJSON
            $.LoadingOverlay("remove");
            if (res.status == 422) {
                showFormValidationError(json)
                return;
            }
            if (json.citadel) {
                getPlugins(json.citadel).set(config.citadel).init()
            } else if (config.swalFatalErrorMessage) {
                Swal.fire(config.swalFatalErrorMessage)
            } else if (json.error) {
                Swal.fire({
                    type: 'error',
                    html: json.error.message,
                })
            } else {
                if (json.message) {
                    Swal.fire({
                        type: 'error',
                        title: "Terjadi kesalahan.",
                        html: json.message
                    })
                } else {
                    Swal.fire({
                        type: 'error',
                        html: "Terjadi kesalahan."
                    })
                }
            }
        },
        complete: () => {
            $.LoadingOverlay('remove')
        }
    });
}



/**
 * Serializes form data into an object.
 * @param {Array} array The form data as an array.
 * @returns {object} The serialized form data.
 */
export function serializeFormData(array) {
    return array.reduce((acc, input) => {
        $(`input[name="${input.name}"]`).removeClass('invalid'); // Template literal

        const isArrayKey = input.name.endsWith('[]');
        const key = isArrayKey ? input.name.slice(0, -2) : input.name;

        acc[key] = isArrayKey
            ? (acc[key] || []).concat(input.value)
            : input.value;

        return acc;

    }, {});
}
