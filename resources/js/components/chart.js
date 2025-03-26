import ApexCharts from 'apexcharts'
import { addQueryParams } from '../helpers';

export default function CitadelChart(el)
{
    const name = el.attr('name')
    axios.get(addQueryParams(location.href, {
        f: "reactive",
        c: name,
    })).then(response => {
        const config = response.data
        const chart = new ApexCharts(el[0], config)
        chart.render()
    }).catch(errors => {
        el.html = JSON.stringify(errors)
    })
}
