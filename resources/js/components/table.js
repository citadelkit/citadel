import DataTable from 'datatables.net-bs5';
import 'datatables.net-buttons-bs5';
import 'datatables.net-responsive-bs5';
import { addQueryParams } from '../helpers';
import { serializeFormData } from '../helpers/form_submit';

const basic = {
    layout: {
        topStart: null,
        bottom: {
            div: {
                className: 'bottom-center-table',
            }
        },
        bottomStart: null,
        bottomEnd: null
    },
    paging: false,
    searching: false,
}

export function CitadelTableWatchEvent() {
    window.addEventListener(
        'CTable:reload',
        async (e) => {
            const detail = e.detail
            const filter_form = $("#" + detail.form_name)
            const args = serializeFormData(filter_form.serializeArray())
            const table = new DataTable.Api("table#" + detail.table_name)
            const url = table.ajax.url()
            table.processing(true)
            await table.ajax.url(addQueryParams(url, args)).load()
            table.processing(false)
        })
    window.addEventListener(
        'CTable:apply-filter',
        async (e) => {
            const detail = e.detail
            const filter_form = $("#" + detail.form_name)
            const args = serializeFormData(filter_form.serializeArray())
            const table = new DataTable.Api("table#" + detail.table_name)
            const url = table.ajax.url()
            table.processing(true)
            await table.ajax.url(addQueryParams(url, args)).load()
            table.processing(false)
        })
    window.addEventListener(
        'CTable:reset-filter',
        async (e) => {
            const detail = e.detail
            const filter_form = $("#" + detail.form_name)
            filter_form.find('select, input').each(function () { // Include input elements
                $(this).val("").trigger("change");
                this.selectize?.clear()
            });
            const args = serializeFormData(filter_form.serializeArray())
            const table = new DataTable.Api("table#" + detail.table_name)
            const url = table.ajax.url()
            table.processing(true)
            await table.ajax.url(addQueryParams(url, args)).load()
            table.processing(false)
        })
}

export default function CitadelTable(el) {
    init(el)
}

function refresh($table) {
    const name = $table.attr('citadel-name');
    const tableInstance = $table;
    if (!tableInstance) {
        console.error(`Table instance "${name}" not found.`);
        return;
    }

    $table.bootstrapTable('refresh', {
        url: $table.data('current-url'), // Access href property
        queryParams: $table.data('query-params'),
    });
}

function defaultSources(name) {
    return {
        "parser": location.href + "?f=parser&c=" + name,
        "refresh": addQueryParams(location.href, {
            f: "reactive",
            c: name
        }),
        config: basic,
    };
}

function init($table) {
    if ($table.is('[citadel-table]')) {
        return old($table)
    }
    // Using Jquery Datatable;
    const name = $table.attr('id');
    const c = JSON.parse($table.attr('config'));
    const custom = $.extend(defaultSources(name), c)

    const dt = new DataTable($table,
        $.extend(c.config, {
            ajax: c.method == "get" ? {
                url: custom.refresh,
            } : {
                url: custom.refresh,
                type: 'POST',
                beforeSend: function (request) {
                    request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
                },
            },
        })
    )

    if (c.numbering) {
        numbering(dt)
        dt.on('draw', function () {
            numbering(dt)
        });
    }

    function numbering(dt) {
        var i = dt.page.info().start + 1;
        dt.cells(null, 0, { search: 'applied', order: 'applied' })
            .every(function (cell) {
                this.data(i++);
            });
    }

    const filterControl = $("#control-" + name).removeClass('d-none').detach()
    const filterTarget = $("#button-filter-" + name)
    filterTarget.html(filterControl)
}


function old($table) {
    function init($table) {
        const tableUrl = new URL($table.attr('citadel-src'));
        const configUrl = new URL($table.attr('citadel-src'));
        const afterEffect = $table.attr('data-after-effect');
        const filterSelector = $table.attr('citadel-filter');
        const name = $table.attr('citadel-name');
        const $filter = $(filterSelector); // Cache the filter element


        if ($table.hasClass('citadel-created')) {
            return
        } else {
            $table.addClass('citadel-created')
        }

        const queryParams = (params) => {
            $filter.find('select, input[type!="button"]').each(function () { // Include input elements and exclude buttons
                params[$(this).attr('name')] = $(this).val() || undefined;
            });
            params.context = "get_data";
            params.origin_url = window.location.href;
            params.citadel_component = name;
            return params;
        };

        const countFilter = () => {
            let total = 0;
            $filter.find('select, input[type!="button"]').each(function () { // Include input elements
                var value = $(this).val();
                if (value.length !== 0) {
                    total += !!$(this).val(); // Use boolean coercion
                }

            });
            $filter.find('.count-filter').text(total);
        };

        countFilter();
        $filter.on('change', 'select, input', countFilter); // Include input elements

        $filter.on('click', '[citadel-apply-filter]', () => refresh($table)); // Use arrow function to preserve 'this'


        $filter.on('click', '[citadel-remove-filter]', () => {
            $filter.find('select, input').each(function () { // Include input elements
                $(this).val("").trigger("change");
            });
            refresh($table); // Use arrow function
        });

        $filter.on('click', '[citadel-toggle-filter]', () => {
            $filter.closest('.bootstrap-table-filter-container').toggleClass('filter-hide');
        });

        configUrl.searchParams.append("citadel_component", name);
        configUrl.searchParams.append("origin_url", window.location.href);
        configUrl.searchParams.append("context", "get_config");
        $table.LoadingOverlay('show')
        $.get(configUrl.href).done(data => {
            const { tableConfig, filters } = data;

            $table.bootstrapTable({
                toolbar: filterSelector,
                url: tableUrl.href,
                queryParams: queryParams,
                cookieIdTable: $table.attr('id'), // Get ID directly from $table
                ...tableConfig,
                onLoadSuccess: window[afterEffect], // Ensure afterEffect is a function
            });

            if (tableConfig.clickToSelect) {
                const $selector = $(`#table-container-${name} [name=${name}]`);
                $selector.selectize({
                    maxItems: tableConfig.singleSelect ? 1 : null,
                    valueField: 'id',
                    labelField: 'title',
                    options: [],
                    create: false,
                    persist: false,
                })
                $selector.siblings('.selectize-control').removeClass('d-none')
                $selector[0].selectize.lock()
                $table.on('check.bs.table', function (row, $el) {
                    const { idField, valueField } = tableConfig.selectOption
                    function extractField(str) {
                        if (str.startsWith("$")) {
                            return [str.substring(1), true];
                        } else {
                            return [str, false]; // or handle invalid input as needed
                        }
                    }
                    const compileNotation = function (prev, i) {
                        const [string, isVar] = extractField(i)
                        prev += isVar ? $el[string] : string;
                        return prev
                    }
                    const id = Array.isArray(idField)
                        ? idField.reduce(compileNotation, "")
                        : [idField].reduce(compileNotation, "")
                    const title = Array.isArray(valueField)
                        ? valueField.reduce(compileNotation, "")
                        : [valueField].reduce(compileNotation, "")

                    $selector[0].selectize.addOption({
                        id: id,
                        title: title
                    })
                    $selector[0].selectize.setValue(id);
                })
            }

            // Improved filter insertion
            const filterId = `#filter_container_${$table.attr('id')}`;
            $(filters).insertBefore(filterId);
            $(filterId).find('.select2').select2({
                placeholder: "Pilih opsi",
                width: '100%',
            });
        }).fail(() => {
            console.error(`Failed to fetch table config from ${configUrl.href}`); // Add error handling
        }).always(() => {
            $table.LoadingOverlay('hide')
        });

        $table.data('current-url', tableUrl.href)
        $table.data('query-params', JSON.stringify(queryParams))

        // $.fn.citadel.table[name] = {
        //     table: $table,

        //     current_url: tableUrl,  // Store URL object
        //     queryParams: queryParams
        // };
    }

    init($table)
    $table.parent().append(`<div class='text-warning'><i class="ft-alert-triangle"></i>Deprecated table components</div>`);
}
