import Select2 from 'select2';
import '@selectize/selectize';
import { citadelFetchComponentLifeCycle } from '../helpers';

export default function CitadelSelect(el) {
    if (el.attr('citadel-input')) {
        return old(el)
    }

    const c = JSON.parse(el.attr('config'));
    const id = el.attr('id')

    if(c.config == undefined) {
        return;
    }
    let config = {
        // plugins: ["clear_button"],
        dropdownParent: el.parent(),
        showAddOptionOnCreate: false,
        ...c.config
    }

    if(c.reactive) {
        config.ajax = {
            url: citadelFetchComponentLifeCycle(id),
            dataType: 'json'
        }
    }

    new Select2({
        $container: el,
        options: { options: config }
    })

    // el.select2(config)


}

function loadOptions(el, id) {
    const url = citadelFetchComponentLifeCycle(id)
    $.ajax({
        url,
        type: 'GET',
        dataType: 'json',
        success: function (res) {
            console.log("SELECTIZE ELEMENT: ", el)
            el.clearOptions();
            el.addOption(res);
            el.refreshOptions()
            el.enable();
        }
    });
}

function old($select) {
    const config = $select.attr('citadel-input') ? JSON.parse($select.attr('citadel-input')) : {}
    const name = $select.attr('name');
    const depend_on = $select.attr('depend-on')
    const citadelUrl = $select.data('citadel-url');
    const paramNameJson = $select.data('citadel-param-name'); // Get citadel-param-name
    console.log("CITADEL SELECT", $select)
    $select.selectize({
        plugins: ["clear_button"],
        ...config,
        dropdownParent: 'body',
        //use citadel url
        load: citadelUrl ? citadelURLHandler(paramNameJson) : null // If no citadel-url, don't add load function
    })

    const selectizedObj = $select[0].selectize

    if (config.setValue) {
        selectizedObj.setValue(config.setValue);
        selectizedObj.trigger('change');
    }
    if (config.lock == true) {
        selectizedObj.lock();
    }

    if (depend_on) {
        checkValue(selectizedObj)

        $(depend_on).on('change', function (e) {
            checkValue(selectizedObj)
        })
    } else {
        fetchDynamicOptions(name)
    }
}

const setOption = (selectizedObj, data) => {
    const s = selectizedObj
    s.clearOptions();
    for (var i in data) {
        s.addOption(data[i]);
    }
    console.log("SELECTIZE", s)
    s.refreshOptions()
    s.enable();
}

const fetchDynamicOptions = function (name) {
    const params = {
        citadel_component: name,
        context: "get_dynamic_options",
    }
    console.log(params)
    const url = new URL(location.href);
    const searchParams = new URLSearchParams(params);
    url.search = searchParams.toString();
    $.get(url.toString(), function (data) {
        // setOption(selectizedObj, data)
    })
        .always(function () {
            // $select.LoadingOverlay('hide')
        });
}

const checkValue = function (selectizedObj) {
    selectizedObj.disable();
    let allHaveValue = true; // Asumsikan semua memiliki nilai sampai terbukti salah
    $(depend_on).each(function (_, item) {
        if (!$(item).val()) {
            allHaveValue = false;
            return false; // Keluar dari loop jika ada yang tidak memiliki nilai
        }
    });
    if (allHaveValue) {
        if (config._dynamicOptions.dynamic) {
            console.log("CONFIG SELECT 99", config)
            fetchDynamicOptions()
        } else {
            setOption(selectizedObj, config.options)
            selectizedObj.enable();
        }
    } else {
        selectizedObj.disable();
        selectizedObj.clear();
    }

}

const citadelUrlHandler = function (paramNameJson) {
    return function (query, callback) {
        if (!query.length) return callback(); // Skip if query is empty
        const data = {
            search: query, // Pass the query as 'search'
        };
        if (paramNameJson) {
            paramNameJson.forEach((selector) => {
                const $field = $(selector);
                if ($field.length) {
                    const fieldName = $field.attr('name');
                    const fieldValue = $field.val();
                    if (fieldName && fieldValue !== undefined) {
                        data[fieldName] = fieldValue; // Add dynamic parameters
                    }
                }
            });
        }
        $.ajax({
            url: citadelUrl, // Use citadel-url from the element
            type: 'GET',
            dataType: 'json',
            data,
            error: function () {
                callback(); // Handle errors
            },
            success: function (res) {
                const options = Object.keys(res).map(function (key) {
                    return {
                        id: key, // Set 'value'
                        title: res[key], //set 'label'
                    };
                });
                callback(options); // Populate options in the dropdown
            }
        });
    }
}
