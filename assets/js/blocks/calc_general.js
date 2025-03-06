document.addEventListener('DOMContentLoaded', function () {
    // Listen for clicks on all buttons with the class 'pngcalc_stepper'
    document.querySelectorAll('.pngcalc_button.pngcalc_stepper').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault()

            if(!button.classList.contains('ignore-val')) {
                const form = document.getElementById('png-calculator-form'); // Replace with your form's ID
                const formInputs = form.querySelectorAll('#product_quantity')
                if ([...formInputs].some(input => input.classList.contains('invalid'))) {
                    return; // Stop the function
                }
            }

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

    let popupTrigger = document.querySelector('#png-calculator-popup-trigger')
    if (popupTrigger) {
        popupTrigger.addEventListener('click', function (e){
            e.preventDefault();
            let popupCalc = document.querySelector('#png-calculator-popup')
            console.log('popupCalc', popupCalc)
            if (popupCalc) {
                popupCalc.classList.add('active');
            }
        })
    }

    document.addEventListener('click', function (e) {
        let popupCalc = document.querySelector('#png-calculator-popup');
        let calculatorSection = document.querySelector('#png-calculator');

        if (popupCalc && calculatorSection) {
            // Check if the click target is outside the calculator section
            if (!calculatorSection.contains(e.target) && !e.target.closest('#png-calculator-popup-trigger')) {
                popupCalc.classList.remove('active');
            }
        }
    });

    const closerCalc = document.querySelector('#png-calculator__closer');
    if(closerCalc) {
        closerCalc.addEventListener('click', function (e){
            e.preventDefault()
            let popupCalc = document.querySelector('#png-calculator-popup');
            let calculatorSection = document.querySelector('#png-calculator');

            if (popupCalc && calculatorSection) {
                popupCalc.classList.remove('active');
            }
        })
    }
});
