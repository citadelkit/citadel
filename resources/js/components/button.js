import { handleComponent } from "../helpers/plugins";
import CitadelSwal from "./swal";

export default function CitadelButton(element, type) {
    const $el = element;

    let def = JSON.parse($el.attr('data-ct-onclick') || null);
    const disabled = $el.attr('disabled')
    if (disabled == "" | disabled != undefined) {
        $el.on('click', function (e) {
            e.preventDefault()
        })
        return
    }

    if (def == null) return

    $el.on('click', function (e) {
        e.preventDefault()
        if (def.event) {
            handleEvent(def, $el)
            return
        }
        if (def.component) {
            handleComponent(def)
            return
        }
        if (e.target.getAttribute('href')) {
            window.location.href = e.target.getAttribute('href')
            return
        }
    })

    return $el
}

function flyout() {

}


function handleEvent(def, $el) {
    const event = new CustomEvent(def.event, {
        detail: { ...def, srcElement: $el }
    })

    window.dispatchEvent(event)
}
