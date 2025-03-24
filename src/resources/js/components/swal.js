import { getFormData } from "../helpers";
import { getPlugins, handleComponent } from "../helpers/plugins";

export default async function CitadelSwal(args) {
    const { method, config, after_confirm, after_confirm_args, id, name } = args;
    if (config.view) {
        $.LoadingOverlay('show')
        config.html = await $.get(config.view)
        $.LoadingOverlay('hide')
    }
    const isForm = $(config.html).find('form').length > 0;
    if (config.sections?.script) {
        const className = "script-" + name;
        if ($("." + className).length === 0) {
            // Create a new script element
            var script = document.createElement('script');
            script.type = 'text/javascript';
            script.className = className;

            // Extract and set the script content
            var scriptContent = config.sections.script.match(/<script\b[^>]*>([\s\S]*?)<\/script>/i);
            if (scriptContent && scriptContent[1]) {
                script.text = scriptContent[1]; // Set only the script content
                document.body.appendChild(script); // Append it to the body
            } else {
                console.error("No script content found");
            }
        }
    }

    const preConfirm = async () => {
        const form = $('#swal2-content form');
        if (!form) return

        let headers = {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                'content'),
            'Content-Type': "application/json",
            'X-REQUEST-VIA': "citadel-ajax"
        }
        var data = getFormData(form)

        const url = form.attr('action')
        const ajax_config = {
            url: url,
            headers: headers,
            method: form.attr('method') || "GET",
            data: JSON.stringify(data),
        };
        try {
            const response = await $.ajax(ajax_config)
                .done(function (response) {
                    return response
                }).fail(function (res) {
                    if (res.citadel) {
                        getPlugins(res.citadel).init()
                    }
                    return false;
                })
            return response
        } catch (error) {
            if (error.responseJSON.citadel) {
                getPlugins(error.responseJSON.citadel).init()
                return false;
            }
            Swal.showValidationMessage(`Request error: ${error.message}`)
            return false;
        }
    }
    Swal.fire({
        ...config,
        showLoaderOnConfirm: isForm,
        allowOutsideClick: () => !Swal.isLoading(),
        preConfirm: isForm ? preConfirm : undefined
    }).then((result) => {
        console.log(result);
        if (result.dismiss == "cancel" || result.dismiss == "backdrop" || result.dismiss == "esc") {
            $.LoadingOverlay('hide')
            return
        }

        if (after_confirm == "reload") {
            $.LoadingOverlay('show')
            window.location.reload()
        }
        if (after_confirm == "redirect") {
            window.location.href = after_confirm_args
        }
        if (after_confirm?.toUpperCase() == "POST") {
            let headers = {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                    'content'),
                'Content-Type': "application/json",
                'X-REQUEST-VIA': "citadel-ajax"
            }
            console.log();
            Pace.track(function () {
                $.ajax({
                    method: "POST",
                    headers: headers,
                    url: after_confirm_args
                })
                    .fail(function (res) {
                        if (res.citadel) {
                            getPlugins(res.citadel).init()
                        }
                    })
                    .done(function (res) {
                        if (res.citadel) {
                            getPlugins(res.citadel).init()
                        }
                    })
                    .always(function () {
                        $.LoadingOverlay("hide");
                    })
            })
        }

        if (after_confirm == "plugins") {
            getPlugins(after_confirm_args).init()
        }

        if (result.value && result.value.citadel) {
            if (result.value.citadel.component) {
                handleComponent(result.value.citadel)
            } else {
                getPlugins(result.value.citadel).init()
            }
        }
    })
}
