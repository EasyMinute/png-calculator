document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('tape-calculator');
    if (form) {

        const bodyInputs = form.querySelectorAll('.tape-calculator__body input');
        const cuttingCheckbox = document.getElementById('tape-cutting');


        const hiddenInputs = {
            distance: parseFloat(document.getElementById('tape-distance').value),
            tapeWidth: parseFloat(document.getElementById('tape-width').value),
            tapePrice: parseFloat(document.getElementById('tape-price').value),
            cuttingPrice: parseFloat(document.getElementById('tape-cutting-price').value)
        };

        bodyInputs.forEach(input => {
            input.addEventListener('input', handleInputChange);
        });
        if (cuttingCheckbox) {
            cuttingCheckbox.addEventListener('change', handleInputChange);
        }

        function handleInputChange() {
            // Get body input values
            const printWidth = parseFloat(document.getElementById('print_width').value) || 0;
            const printLength = parseFloat(document.getElementById('print_length').value) || 0;
            const printQuantity = parseInt(document.getElementById('print_quantity').value) || 1;
            const cuttingEnabled = cuttingCheckbox.checked;

            // Predefine Variables for calculations
            let effectiveWidth = 0
            let effectiveLength = 0
            let printsQuantOrigin = 0
            let printsQuantReverse = 0
            let columsQuantOrigin = 0
            let columsQuantReverse = 0
            let linearLengthOrigin = 0
            let linearLengthReverse = 0
            let optimalLength = 0
            //Final values
            let optimalOrientation = 'По ширині'
            let tapeLength = 0
            let printPrice = 0
            let totalTapePrice = 0


            // Calculations
            effectiveWidth = printWidth + hiddenInputs.distance
            effectiveLength = printLength + hiddenInputs.distance

            printsQuantOrigin = Math.floor(hiddenInputs.tapeWidth / effectiveWidth)
            printsQuantReverse = Math.floor(hiddenInputs.tapeWidth / effectiveLength)

            columsQuantOrigin = Math.ceil(printQuantity / printsQuantOrigin)
            columsQuantReverse = Math.ceil(printQuantity / printsQuantReverse)

            linearLengthOrigin = columsQuantOrigin + (effectiveLength / 100)
            linearLengthReverse = columsQuantReverse + (effectiveWidth / 100)

            optimalLength = Math.min(linearLengthOrigin, linearLengthReverse)

            //Totals
            if(linearLengthOrigin < linearLengthReverse) {
                optimalOrientation = 'По ширині';
            } else {
                optimalOrientation = 'По довжині';
            }
            tapeLength = optimalLength
            totalTapePrice = tapeLength * hiddenInputs.tapePrice;
            if (cuttingEnabled) {
                totalTapePrice += hiddenInputs.cuttingPrice;
            }
            printPrice = totalTapePrice / printQuantity


            // Update footer fields
            document.getElementById('print_orientation').value = optimalOrientation;
            document.getElementById('tape_length').value = tapeLength.toFixed(2) + ' мп';
            document.getElementById('total_tape_price').value = totalTapePrice.toFixed(2) + ' грн';
            document.getElementById('print_price').value = printPrice.toFixed(2) + ' грн';
        }
    }
});