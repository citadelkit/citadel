import { isEmpty } from "../helpers";

export default function CitadelWizard($wizard) {
    const config = $wizard.attr('wizard-config') ? JSON.parse($wizard.attr('wizard-config')) : {};
    const inputs = $wizard.find('input,select,textarea')
    const rules = {};
    const $form = $wizard.parents('form')
    inputs.each(function (_, input) {
        input = $(input);
        const name = input.attr('name');
        const isFacade = input.attr('facade') != undefined;
        const rule = input.attr('citadel-rule') ? JSON.parse(input.attr('citadel-rule')) : {};
        if (!isEmpty(rule) && name && !isFacade) {
            rules[name] = rule
        }
    })

    if (!isEmpty(rules)) {
        $form.validate({
            errorPlacement: function errorPlacement(error, element) { element.parents('.form-group').children('.text-danger').append(error); },
            rules: rules ?? undefined,
            ignore: ":disabled"
        })
    }

    $wizard.steps({
        headerTag: ".step-label",
        bodyTag: "section.step-content",
        transitionEffect: "fade",
        stepsOrientation: "horizontal",
        enableCancelButton: false,
        enableFinishButton: false,
        titleTemplate: '<div step="#index#">#title#</div>',
        ...config,
        onStepChanging: function (event, currentIndex, newIndex) {
            // Allways allow previous action even if the current form is not valid!
            if (currentIndex > newIndex) {
                return true;
            }

            const isValid = $form.valid();
            return isValid;
        },
        onStepChanged: function (event, currentIndex, priorIndex) {

        },
        onFinishing: function (event, currentIndex, priorIndex) {

        },
        onInit: function (event, currentIndex) { }
    })
}
