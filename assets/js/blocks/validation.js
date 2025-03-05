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

    $("#submitCalc").on("mouseup", function (e) {
        e.preventDefault();
        e.stopPropagation();
        let isValid = true;

        // Validate required fields
        $(".required").each(function () {
            validateField($(this), $(this).val().trim() !== "");
            if ($(this).hasClass("invalid")) isValid = false;
        });

        // Validate email
        $(".required-email").each(function () {
            let email = $(this).val().trim();
            let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            validateField($(this), emailPattern.test(email));
            if ($(this).hasClass("invalid")) isValid = false;
        });

        // Validate phone
        $(".required-phone").each(function () {
            validateField($(this), Inputmask.isValid($(this).val(), { mask: "+38 (099) 999 99 99" }));
            if ($(this).hasClass("invalid")) isValid = false;
        });

        if (isValid) {
            console.log("Form submitted successfully!"); // Replace with actual form submission
            // $('#png-calculator-form').submit();
        }

        $("#calc_print_files").each(function () {
            var files = this.files;
            var maxFiles = 5;
            var maxSize = 10 * 1024 * 1024; // 8MB in bytes

            if (files.length > maxFiles) {
                $("#calc_print_files").addClass('invalid')
                this.value = ""; // Clear the input
                return;
            }

            for (var i = 0; i < files.length; i++) {
                if (files[i].size > maxSize) {
                    $("#calc_print_files").addClass('invalid')
                    this.value = ""; // Clear the input
                    return;
                }
            }
        });
    });

    // Remove invalid class when typing
    $("input").on("input", function () {
        $(this).removeClass("invalid");
    });
});
