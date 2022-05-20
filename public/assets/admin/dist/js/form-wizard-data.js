/*FormWizard Init*/
$(function() {
    "use strict";

    /* Basic Wizard Init*/
    if ($('#example-basic').length > 0)
        $("#example-basic").steps({
            headerTag: "h3",
            bodyTag: "section",
            transitionEffect: "fade",
            autoFocus: true,
            titleTemplate: '<span class="number">#index#</span> #title#',
        });


    var form_2 = $("#example-advanced-form");
    form_2.steps({
        headerTag: "h3",
        bodyTag: "fieldset",
        transitionEffect: "fade",
        titleTemplate: '#title#',
        labels: {
            finish: "Complete",
            next: "Continue",
            previous: "Previous",
        },
        onStepChanging: function(event, currentIndex, newIndex) {
            // Allways allow previous action even if the current form is not valid!
            if (currentIndex > newIndex) {
                return true;
            }

            // Needed in some cases if the user went back (clean up)
            if (currentIndex < newIndex) {
                // To remove error styles
                form_2.find(".body:eq(" + newIndex + ") label.error").remove();
                form_2.find(".body:eq(" + newIndex + ") .error").removeClass("error");
            }
            form_2.validate().settings.ignore = ":disabled,:hidden";
            return form_2.valid();
        },
        onFinishing: function(event, currentIndex) {
            form_2.validate().settings.ignore = ":disabled";
            return form_2.valid();
        },
        onFinished: function(event, currentIndex) {
            alert("Click on the register button!");
        }
    })



});