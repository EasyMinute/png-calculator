document.addEventListener('DOMContentLoaded', function () {
    // Listen for clicks on all buttons with the class 'pngcalc_stepper'
    document.querySelectorAll('.pngcalc_button.pngcalc_stepper').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault()
            const step = this.getAttribute('data-step'); // Get the 'data-step' attribute of the button

            // Hide all elements with the class 'pngcalc__step'
            document.querySelectorAll('.pngcalc__step').forEach(stepElement => {
                stepElement.classList.add('hidden');
            });

            // Show the element with the matching 'data-step'
            const targetStep = document.querySelector(`.pngcalc__step[data-step="${step}"]`);
            if (targetStep) {
                targetStep.classList.remove('hidden');
            }
        });
    });
});
