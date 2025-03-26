import CitadelSwal from "../components/swal";
import formSubmit from "./form_submit";

const plugins = {
    ajax_request: {
        async init(context) {
            $.LoadingOverlay('show')
            const { url, method } = this.args;
            // const data = {};

            // Pace.track(function () {
            //     submitFormAction(url, method, data)
            // })
            const ajaxConfig = {
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content'),
                    'X-REQUEST-VIA': "citadel-ajax"
                },
                method: method || "GET",
            }
            const response = await $.ajax(ajaxConfig).done(url, function (response) {
                return response;
            }).fail(function () {
                toastr['error'](`Failed Ajax Request to: ${url}`)
            }).always(function () {
                $.LoadingOverlay('hide')
            })
            if (response.citadel) {
                getPlugins(response.citadel).init()
            }
        },
        args: {}
    },
    citadel_widget: {
        async init(context) {
            return await CitadelWidget(context, this.args);
        },
        args: {}
    },
    toastr: {
        async init() {
            const { type, message } = this.args;
            toastr[type || 'info'](message || "test")
        },
        args: {}
    },
    sweet_alert: {
        async init() {
            return await CitadelSwal(this.args);
        },
        args: {}
    },
    form_submit: {
        async init(context) {
            const { form_target, after_submit } = this.args;
            return formSubmit(form_target, after_submit, getPlugins)
        },
        args: {}
    }
}
const components = {
    sweetalert: {
        init(args) {
            CitadelSwal(args)
        }
    }
}

function handleComponent(def) {
    components[def.component].init(def.args)
}


function getPlugins(object, context) {
    let available_plugins = {};
    if (typeof object === 'string' || object instanceof String) object = JSON.parse(object)
    // console.log(object)
    Object.keys(object).forEach(k => {
        // console.log(k)
        let plugin = plugins[k]
        // console.log(plugins, plugin)
        if (plugin !== undefined) {
            plugin.args = object[k]
            available_plugins[k] = plugin
        }
    })

    return {
        init() {
            // console.log("PLUGINS INIT ",this.available_plugins)

            for (const [key, value] of Object.entries(this.available_plugins)) {
                this.available_plugins[key]?.init(this.context)
            }
            return this
        },
        available_plugins,
        context,
        set(citadel) {
            for (const [key, value] of Object.entries(this.available_plugins)) {
                // console.log(key, citadel[key])
                this.available_plugins[key] = { ...value, ...citadel[key] }
            }
            // console.log("PLUGINS SET ",this.available_plugins)
            return this
        }
    }
}


export { getPlugins, handleComponent }
