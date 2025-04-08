import { addQueryParams } from '../helpers';
import axios from 'axios';

export default async function CitadelWidget(el) {
    if(el.is('[citadel-widget]')) {
        return await old(el)
    }
    init(el)
}

async function init(el)
{
    const config = JSON.parse(el.attr('config'))
    const name = el.attr('id')

    if(config.reactive) {
        handleReactive(el, name)
    }
}

async function handleReactive(el, name)
{
    $(el).loadingOverlay()
    axios.get(addQueryParams(location.href, {
        f: "reactive",
        c: name
    })).then(response => {
        el.find('.content').html(response.data)
    }).catch(errors => {
        console.log(errors);
    }).finally(() => {
        $(el).loadingOverlay('remove')
    })
}

async function old(el) {
    const { source } = el.attr('citadel-widget');
    const $content = el.find('.card-content')
    $content.LoadingOverlay("show")
    const response = await $.get(source, function (response) {
        return response;
    }).fail(function () {
        toastr['error'](`Failed fetching widget from ${source}`)
        return "<Error/>"
    })
    $content.LoadingOverlay("hide")
    el.find('#description').html(response);
}
