import $ from "jquery";
import Inputmask from "inputmask";

// Ensure Inputmask works with jQuery
$.fn.inputmask = function (options) {
    return this.each(function () {
        Inputmask(options).mask(this);
    });
};

$(document).ready(function () {
    // Apply phone mask
    $(".required-phone").inputmask("+38 (099) 999 99 99");

    function validateField($input, condition) {
        if (condition) {
            $input.removeClass("invalid");
        } else {
            $input.addClass("invalid");
        }
    }

    $("#submitCalc, .pngcalc_button.pngcalc_stepper").on("mouseup", function (e) {
        e.preventDefault();
        e.stopPropagation();

        let isValid = true;

        // Find the current step
        let $currentStep = $(this).closest(".pngcalc__step"); // Adjust class if needed

        // Validate only fields in the current step
        $currentStep.find(".required").each(function () {
            validateField($(this), $(this).val().trim() !== "");
            if ($(this).hasClass("invalid")) isValid = false;
        });

        // Validate email
        $currentStep.find(".required-email").each(function () {
            let email = $(this).val().trim();
            let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            validateField($(this), emailPattern.test(email));
            if ($(this).hasClass("invalid")) isValid = false;
        });

        // Validate phone
        $currentStep.find(".required-phone").each(function () {
            validateField($(this), Inputmask.isValid($(this).val(), { mask: "+38 (099) 999 99 99" }));
            if ($(this).hasClass("invalid")) isValid = false;
        });

        // Validate file uploads (if applicable in the current step)
        $currentStep.find("#calc_print_files").each(function () {
            var files = this.files;
            var maxFiles = 5;
            var maxSize = 10 * 1024 * 1024; // 10MB

            if (files.length > maxFiles) {
                $(this).addClass("invalid");
                this.value = "";
                return;
            }

            for (var i = 0; i < files.length; i++) {
                if (files[i].size > maxSize) {
                    $(this).addClass("invalid");
                    this.value = "";
                    return;
                }
            }
        });

        if (isValid) {
            console.log("Current step validated successfully!");
            // Proceed to the next step or submit the form
        }
    });

    // Remove invalid class when typing
    $("input").on("input", function () {
        $(this).removeClass("invalid");
    });
});
