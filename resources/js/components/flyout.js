import { Offcanvas } from 'bootstrap';
import { fetchPage } from '../helpers';

export default function CitadelFlyout(element) {
    const $el = $(element);
    if(!element.is('.flyout')) {
        return old(element)
    }
    const def = JSON.stringify($el.attr('config'));
    const $body = $el.find('.offcanvas-body')
    const obj = new Offcanvas(element);

    if (def?.source == "page") {
        $el.on('show.bs.offcanvas', async function (el) {
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
    const def = $el.data('flyout');
    const $body = $el.find('.offcanvas-body')
    const obj = new Offcanvas(element);

    if (def?.source == "page") {
        $el.on('show.bs.offcanvas', async function (el) {
            const args = $(el.relatedTarget).data('flyout')
            $body.html("<div class='m-2'>Fetching Page...<div>")
            const page = await fetchPage(args?.target || def.target)
            $body.html("")
            $body.append(page)
        })
    }
    return obj

}
