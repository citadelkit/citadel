import './components';
import { startObserver, initGlobalFunction } from "./helpers";
import { getPlugins } from "./helpers/plugins";

(function (window, document, $) {
    // CitadelSpinner('document')
    const reinstance = () => {
        $('.filepond').CFilepond()
        $('.offcanvas, .flyout').CFlyout()
        // $('.modal.popup').CModal()

        startObserver()
        initGlobalFunction(window.$)
        $('.citadel-button').CButton()
        $('.citadel-chart').CChart()
        $('.citadel-form').CForm()
        // refreshTable($('[citadel-table]'))
        $('[citadel-table], .citadel-table').CTable()
        // setWizard($('[citadel-wizard]'))
        $('[citadel-wizard]').CWizard()
        $('[citadel-modal]').CModal()
        // setSelectize($('select[citadel-input]'))
        $('select[citadel-input], .citadel-select').CSelect()
        // setDatePicker($('[citadel-datepicker]'))
        $('[citadel-datepicker]').CDatepicker()
        setAppend($('button[citadel-append]'))
        // startWidget($('[citadel-widget]'))
        $('[citadel-widget], .citadel-widget').CWidget()


        $(document).on('submit', 'form[citadel-ajax]', event => {
            event.preventDefault()
        })


        $(document).on('keydown', '#swal2-content textarea', event => {
            // ("KEYDOWN")
            if (event.key === "Enter" && (event.metaKey || event.ctrlKey)) {
                $('.swal2-actions .swal2-confirm').click()
            }
        })

        $(document).on('click', '[citadel-onclick]', function (event) {
            const $target = $(this)
            const plugins = $target.attr('citadel-onclick');
            // ($target, plugins)
            event.preventDefault()

            getPlugins(plugins, $target).init()
        })
    }

    reinstance()

    const fetchSidebar = () => {
        ("FETCH SIDEBAR")
        $.get("/admin/app/sidebar", function (data) {
            // localStorage.setItem(sidebarKey, JSON.stringify(data.sidebar));
            renderSidebarMenu(data.sidebar);
        }).fail(function () {
            console.error("Error fetching sidebar data"); // Add error handling
        });
    }

    const renderSidebarMenu = (dataMenu) => {
        if(dataMenu == undefined) return;
        const $navigation = $('.navigation-main'); // Cache the navigation element
        $navigation.html("");
        $('.app-sidebar').loadingOverlay();
        $navigation.append(dataMenu.map(createMenuItem));
        $('.app-sidebar').loadingOverlay("remove");
    }

    const createMenuItem = (item, hasParent = false) => {
        const li = $('<li class="citadel-menu-item"></li>');
        const menuTitle = $('<span class="menu-title"></span>').text(item.label); // Use text() for simple text
        const icon = $('<i></i>').addClass(item.icon ?? 'ft-list');
        const a = $('<a class="nav_link"></a>')
            .attr('href', item.url)
            .attr('id', item.id)
            .prepend(icon) // Prepend icon for better readability
            .append(menuTitle);

        if (item.url === window.location.pathname) {
            li.addClass('active');
        }

        if (item.children && item.children.length > 0) {
            const ul = $('<ul class="menu-content"></ul>');
            item.child_active = false
            item.children.map(child => { // Use some for checking child activity
                const childItem = createMenuItem(child, true);
                ul.append(childItem);
                if (childItem.hasClass('active')) item.child_active = true;
            });
            a.attr('href', 'javascript:void(0)');
            li.append(a);
            li.append(ul);
            li.addClass('has-sub');
        } else {
            li.append(a);
        }


        if (item.child_active) {
            li.addClass('active open');
        }


        return li;
    }

    fetchSidebar();

    $("#sidebarToggle").on('click', function () {
        setTimeout(() => {
            localStorage.setItem("app.menu", JSON.stringify($.app.menu));
        }, 500);
    });

    // Citadel Table
    $.citadel = {}; // Ensure citadel namespace exists

    //Citadel Append
    $.citadel.append = {
        init($append) {
            const depend_on = $append.attr('depend-on')
            const checkValue = function () {
                $append.prop('disabled', true);
                let allHaveValue = true;
                $(depend_on).each(function (_, item) {
                    if (!$(item).val()) {
                        allHaveValue = false;
                        return false;
                    }
                });
                if (allHaveValue) {
                    $append.prop('disabled', false);
                } else {
                    $append.prop('disabled', true);
                }
            }

            if (depend_on) {
                checkValue()
                $(depend_on).on('change', function (e) {
                    checkValue()
                })

            }

        }

    };

})(window, document, jQuery)

function setAppend(components) {
    components.each((_, append) => {
        const $append = $(append)
        $.citadel.append.init($append)
    })
}


function handlePlugins(plugins) {
    getPlugins(plugins).init()
}


export { handlePlugins }
