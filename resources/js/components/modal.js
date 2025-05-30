import { Modal } from 'bootstrap';
import { fetchPage } from '../helpers';

export default function CitadelModal(element) {
    const $el = $(element);
    if(!element.data('modal')) {
        return old(element)
    }
    const def = JSON.stringify($el.attr('config'));
    const $body = $el.find('.offcanvas-body')
    const obj = new Modal(element);

    if (def?.source == "page") {
        $el.on('show.bs.modal', async function (el) {
            const args = $(el.relatedTarget).data('flyout')
            $body.html("<div class='m-2'>Fetching Page...<div>")
            const page = await fetchPage(args?.target || def.target)
            $body.html("")
            $body.append(page)
        })
    }
    return obj
}

function old(element) {
    const $el = $(element);
    const def = $el.data('modal');
    const $body = $el.find('.modal-body')
    console.log("MODAL ", $el, def, $body)
    const obj = new Modal(element);
    if (def?.source == "page") {
        $el.on('show.bs.modal', async function (el) {
            console.log(el.relatedTarget)
            const args = $(el.relatedTarget).data('modal')
            $body.html("<div class='m-2'>Fetching Page...<div>")
            console.log("Fetching Page..")
            const page = await fetchPage(args?.target || def.target)
            $body.html("")
            $body.append(page)
            reinstance()
        })
    }
    return obj
}
