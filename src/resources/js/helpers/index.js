/**
 * Fetch Page from Citadel Server
 *
 * @param {*} $url
 * @returns
 */
const fetchPage = ($url) => {
    const headers = {
        'X-Citadel-Request': 'page',
    }
    return axios
        .get($url, { headers })
        .then(response => {

            // Handle the response
            console.log('Status:', response.status);         // HTTP status code
            console.log('Headers:', response.headers);       // Response headers
            console.log('Data:', response.data);             // Response body
            return response.data;
        })
        .catch(error => {
            // Handle errors
            if (error.response) {
                // Server responded with a status other than 2xx
                console.error('Error Status:', error.response.status);
                console.error('Error Data:', error.response.data);
                console.error('Error Headers:', error.response.headers);
            } else if (error.request) {
                // Request was made but no response received
                console.error('No Response:', error.request);
            } else {
                // Something happened in setting up the request
                console.error('Error Message:', error.message);
            }
            return error.response
        })
}


const isEmpty = (value) => {
    if (value == null) return true; // Covers both null and undefined

    if (Array.isArray(value)) {
        return value.length === 0;
    } else if (typeof value === 'object') {
        return Object.keys(value).length === 0;
    }
    return false;
}

/**
 * Gets form data and handles array inputs correctly.
 * @param {jQuery} $form The jQuery form object.
 * @returns {object} The form data as an object.
 */
function getFormData($form) {
    const formData = {};
    $form.serializeArray().forEach(n => {
        const name = n.name.endsWith('[]') ? n.name.slice(0, -2) : n.name;
        formData[name] = formData[name] ? (Array.isArray(formData[name]) ? formData[name].concat(n.value) : [formData[name], n.value]) : n.value;
    });
    return formData;
}



function Action(target) {
    if (target instanceof jQuery) {
        target = target.get(0); // Convert jQuery object to DOM element
    }

    const url = target.getAttribute('citadel-url');
    const paramNameJson = target.getAttribute('citadel-param-name'); // Get citadel-param-name
    const targetSelector = target.getAttribute('citadel-target');

    if (url && targetSelector) {
        const targetElement = document.querySelector(targetSelector);
        let queryParams = [];
        if (paramNameJson) {
            try {
                const paramNames = JSON.parse(paramNameJson); // Parse JSON
                paramNames.forEach(name => {
                    console.log(name)
                    const element = document.querySelector(name); // Find element by name
                    if (element) {
                        const value = element.value || ''; // Get value of the input/select
                        queryParams.push(`${element.name}=${value}`); // Construct query param
                    } else {
                        console.warn(`Element not found for name: ${name}`);
                    }
                });
            } catch (error) {
                console.error('Error parsing `citadel-param-name`: ', error);
            }
        }
        const queryString = queryParams.join('&'); // Join all parameters with '&'
        const requestUrl = queryString ? `${url}?${queryString}` : url;

        $.ajax({
            url: requestUrl,
            type: 'GET',
            beforeSend: function () {
                $(targetElement).LoadingOverlay("show");
            },
            complete: function () {
                $(targetElement).LoadingOverlay("hide");
            },
            success: function (result) {
                if (targetElement) {
                    targetElement.insertAdjacentHTML('beforeend', result);
                    const dateInputs = targetElement.querySelectorAll('input.date');
                    const SelectInputs = targetElement.querySelectorAll('select');
                    $(SelectInputs).selectize({
                        plugins: ["clear_button", 'auto_position'],
                        dropdownParent: 'body',
                    });
                    $(dateInputs).datepicker({
                        format: "dd/mm/yyyy"
                    });
                } else {
                    console.error(`Target element not found for selector: ${result}`);
                }
            }
        })


    } else {
        console.error('Missing required attributes `citadel-append` or `citadel-target`');
    }

}



// Function to handle mutations
function handleMutations(mutationsList) {
    for (const mutation of mutationsList) {
        if (mutation.type === 'childList') {
            mutation.addedNodes.forEach(node => {
                // Check if the added node is an instance of 'citadel-widget'
                if (node.nodeType === Node.ELEMENT_NODE && node.tagName === 'CITADEL-WIDGET') {
                    handleNewWidget(node);
                }
            });
        }
    }
}

function startObserver() {
    const observer = new MutationObserver(handleMutations);
    const targetNode = document.body;
    const config = { childList: true, subtree: true };
    observer.observe(targetNode, config);
}

function addQueryParams(url, newParams) {
    let urlObj = new URL(url, window.location.origin); // Ensures proper parsing
    $.each(newParams, function(key, value) {
        urlObj.searchParams.set(key, value); // Adds or updates query parameters
    });
    return urlObj.toString();
}

function citadelFetchComponentLifeCycle(c, f = 'reactive') {
    return addQueryParams(location.href, {f, c})
}

export { fetchPage, isEmpty, getFormData, Action, startObserver, addQueryParams, citadelFetchComponentLifeCycle }
