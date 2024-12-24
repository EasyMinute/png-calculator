import $ from 'jquery';  // Make sure jQuery is installed
import 'select2/dist/css/select2.css'; // Import the Select2 CSS
import 'select2'; // Import Select2 JavaScript

document.addEventListener('DOMContentLoaded', function () {
    const productQuantityInput = document.getElementById('product_quantity');
    const productPriceInput = document.getElementById('product_price');
    const productFinalPriceInput = document.getElementById('product_final_price');
    const productSumInput = document.getElementById('product_sum');

    const productPriceKoefs = pngCalculatorData.productPriceKoefs


    function calculateFinalPriceAndSum() {
        const productQuantity = parseInt(productQuantityInput.value) || 0;
        const productPrice = parseFloat(productPriceInput.value) || 0;

        if (productQuantity === 0 || productPrice === 0) {
            productFinalPriceInput.value = '';
            productSumInput.value = '';
            console.log('Empty fields')
        }

        // Find the correct coefficient from productPriceKoefs
        let koef = null;
        productPriceKoefs.forEach(priceRange => {
            if (productPrice >= priceRange.price_min && productPrice <= priceRange.price_max) {
                priceRange.quantity_rows.forEach(quantityRange => {
                    if (productQuantity >= quantityRange.quantity_min && productQuantity <= quantityRange.quantity_max) {
                        koef = parseFloat(quantityRange.koef);
                    }
                });
            }
        });

        // If no coefficient is found, set outputs to empty
        if (koef === null) {
            productFinalPriceInput.value = '';
            productSumInput.value = '';
            return;
        }

        // Calculate the final price and sum
        const productFinalPrice = productPrice * koef;
        const productSum = productFinalPrice * productQuantity;

        productFinalPriceInput.value = productFinalPrice.toFixed(2);
        productSumInput.value = productSum.toFixed(2);
    }

    // Add event listeners to inputs
    productQuantityInput.addEventListener('input', calculateFinalPriceAndSum);
    productPriceInput.addEventListener('input', calculateFinalPriceAndSum);
});




// PRINT CALCULATION
document.addEventListener('DOMContentLoaded', function () {
    const maxPrints = 5; // Maximum allowed print configurations
    let currentPrints = 0; // Current count of visible print groups
    const printGroupsContainer = document.getElementById('printGroupsContainer');
    const addPrintButton = document.getElementById('addPrint');
    const removePrintButton = document.getElementById('removePrint');
    const productQuantityInput = document.getElementById('product_quantity'); // Product quantity input
    const printFinalPriceInput = document.getElementById('print_final_price'); // Final price per print
    const printSumInput = document.getElementById('print_sum'); // Total print sum

    // Map of print types to their corresponding koefs arrays
    const koefsMap = {
        sublimation: pngCalculatorData.sublimationKoefs,
        whiteDirect: pngCalculatorData.whiteDirectKoefs,
        colorDirect: pngCalculatorData.colorDirectKoefs,
        dtf: pngCalculatorData.dtfKoefs,
    };

    // Initialize Select2 on all printType and printFormat dropdowns
    // function initializeSelect2() {
    //     $('.printType').select2({});
    //
    //     $('.printFormat').select2({});
    // }


    // Function to create a new print group
    function createPrintGroup() {
        const template = document.querySelector('.print-group-template');
        const newGroup = template.cloneNode(true); // Clone the hidden template
        newGroup.style.display = ''; // Unhide the new group
        newGroup.classList.remove('print-group-template'); // Remove the template class

        // Attach event listeners to the new group's dropdowns
        const printTypeSelect = newGroup.querySelector('.printType');
        const printFormatSelect = newGroup.querySelector('.printFormat');

        printTypeSelect.addEventListener('change', function () {
            populatePrintFormats(printTypeSelect.value, printFormatSelect);
            calculatePrintCosts(); // Recalculate costs when type changes
        });

        printFormatSelect.addEventListener('change', calculatePrintCosts); // Recalculate costs when format changes
        productQuantityInput.addEventListener('input', calculatePrintCosts); // Recalculate when quantity changes

        printGroupsContainer.appendChild(newGroup); // Add the new group to the container
        // Reinitialize Select2 on newly added elements
        // initializeSelect2();

    }

    // Function to populate the format dropdown based on selected type
    function populatePrintFormats(printType, formatSelect) {
        const koefs = koefsMap[printType] || []; // Get the koefs array or an empty array
        formatSelect.innerHTML = ''; // Clear existing options

        // Populate the dropdown with options
        koefs.forEach(({ format }) => {
            const option = document.createElement('option');
            option.value = format.value;
            option.textContent = format.label;
            formatSelect.appendChild(option);
        });
    }

    // Function to calculate and update the print costs
    function calculatePrintCosts() {
        const printGroups = Array.from(printGroupsContainer.querySelectorAll('.pngcalc__block__group'));
        const productQuantity = parseInt(productQuantityInput.value) || 0;

        if (productQuantity === 0) {
            printFinalPriceInput.value = '';
            printSumInput.value = '';
            return;
        }

        let totalPrice = 0; // To calculate total cost across all groups

        printGroups.forEach(group => {
            const printTypeSelect = group.querySelector('.printType');
            const printFormatSelect = group.querySelector('.printFormat');

            const selectedPrintType = printTypeSelect.value;
            const selectedFormat = printFormatSelect.value;

            if (!selectedPrintType || !selectedFormat) return;

            const koefs = koefsMap[selectedPrintType] || [];
            const formatData = koefs.find(item => item.format.value === selectedFormat);

            if (!formatData) return;

            const priceData = formatData.products_price;
            const matchedKoef = priceData.find(priceRange => {
                return (
                    productQuantity >= parseInt(priceRange.quantity_min) &&
                    productQuantity <= parseInt(priceRange.quantity_max)
                );
            });

            if (matchedKoef) {
                const unitPrice = parseFloat(matchedKoef.koef);
                totalPrice += unitPrice; // Accumulate price from all groups
            }
        });

        // Update the price fields
        printFinalPriceInput.value = totalPrice.toFixed(2); // Price per unit
        printSumInput.value = (totalPrice * productQuantity).toFixed(2); // Total cost
    }

    // Add a new print group
    addPrintButton.addEventListener('click', function (e) {
        e.preventDefault();
        if (currentPrints < maxPrints) {
            createPrintGroup();
            currentPrints++;
        }
    });

    // Remove the last visible print group
    removePrintButton.addEventListener('click', function (e) {
        e.preventDefault();
        if (currentPrints > 0) {
            const lastGroup = printGroupsContainer.lastElementChild;
            printGroupsContainer.removeChild(lastGroup); // Remove the last group
            currentPrints--;
            calculatePrintCosts(); // Recalculate after removing a group
        }
    });

    // Initialize hidden print groups on page load
    function initializePrintGroups() {
        for (let i = 0; i < maxPrints; i++) {
            const printTypeSelect = document.getElementById(`printType_${i}`);
            const printFormatSelect = document.getElementById(`printFormat_${i}`);
            if (printTypeSelect && printFormatSelect) {
                printTypeSelect.closest('.pngcalc__block__group').style.display = 'none';
            }
        }
    }

    initializePrintGroups();
    // Initialize on page load
    // initializeSelect2();
});

