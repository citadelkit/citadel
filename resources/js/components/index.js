import CitadelTable, { CitadelTableWatchEvent } from "./table";
import CitadelFileUpload from "./fileupload";
import CitadelSelect from "./select";
import CitadelModal from "./modal";
import CitadelFlyout from "./flyout";
import CitadelWizard from "./wizard";
import CitadelDatepicker from "./datepicker";
import CitadelWidget from "./widget";
import CitadelChart from "./chart";
import CitadelButton from "./button";
import CitadelForm, { CitadelFormWatchEvent } from "./form";

(function (window, document, $) {
    $.fn.instances = {
        table: {}
    }

    const watchEvent = () => {
        CitadelTableWatchEvent();
        CitadelFormWatchEvent();
    }

    const through = function (callback) {
        return function () {
            if(this.length < 1) return
            return Array.from(this).forEach(el => {
                callback($(el))
            })
        }
    }
    console.log($, 'INSTANCE')
    $.fn.CButton = through(CitadelButton)
    $.fn.CForm = through(CitadelForm)
    $.fn.CChart = through(CitadelChart)
    $.fn.CFlyout = through(CitadelFlyout)
    $.fn.CModal = through(CitadelModal)
    $.fn.CFilepond = through(CitadelFileUpload)
    $.fn.CSelect = through(CitadelSelect)
    $.fn.CTable = through(CitadelTable)
    $.fn.CWizard = through(CitadelWizard)
    $.fn.CDatepicker = through(CitadelDatepicker)
    $.fn.CWidget = through(CitadelWidget)

    watchEvent()

    console.log("COMPONENT READY", $.fn.CTable)
})(window, document, jQuery)
