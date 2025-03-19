import $ from 'jquery'; // Import jQuery
import 'select2/dist/css/select2.css'; // Import Select2 CSS
import 'select2'; // Import Select2 JavaScript

document.addEventListener('DOMContentLoaded', function () {

    function isMobile() {
        return /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
    }

    const productQuantityInput = document.getElementById('product_quantity');
    const productPriceInput = document.getElementById('product_price');
    const productFinalPriceInput = document.getElementById('product_final_price');
    const productSumInput = document.getElementById('product_sum');

    const productPriceKoefs = pngCalculatorData.productPriceKoefs;
    const productDiscountKoefs = pngCalculatorData.productDiscountKoefs;
    console.log(productDiscountKoefs);

    // Function to calculate final price and sum
    function calculateFinalPriceAndSum() {

        const productQuantity = parseInt(productQuantityInput.value) || 0;
        const productPrice = parseFloat(productPriceInput.value) || 0;


        if (productQuantity === 0 ) {
            productFinalPriceInput.value = '';
            productSumInput.value = '';
            return;
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

        if (koef === null) {
            productFinalPriceInput.value = '';
            productSumInput.value = '';
            return;
        }

        // Calculate the final price
        let productFinalPrice = productPrice * koef;

        // ✅ Apply discount if a discount is selected
        const discountSelect = document.querySelector('.prodDiscounts');
        if (discountSelect) {
            const selectedDiscountId = discountSelect.value; // Get selected discount ID

            // Find the selected discount object in productDiscountKoefs
            const selectedDiscount = productDiscountKoefs.find(discount => discount.id === selectedDiscountId);

            if (selectedDiscount) {
                // Find the discount value based on price bounds
                const discountValue = selectedDiscount.values.find(valueRange => {
                    return productPrice >= parseFloat(valueRange.price_min) && productPrice <= parseFloat(valueRange.price_max);
                });

                if (discountValue) {
                    const discountMultiplier = parseFloat(discountValue.value);
                    productFinalPrice = productPrice * discountMultiplier; // Apply discount
                }
            }
        }

        // Calculate the final sum
        let productSum = productFinalPrice * productQuantity;

        productFinalPriceInput.value = productFinalPrice.toFixed(2);
        productSumInput.value = productSum.toFixed(2);

        updateTotalSpans(); // Update spans after recalculating
    }

    productQuantityInput.addEventListener('input', calculateFinalPriceAndSum);
    productPriceInput.addEventListener('input', calculateFinalPriceAndSum);
    productPriceInput.addEventListener('change', calculateFinalPriceAndSum);

    // PRINT CALCULATION
    const maxPrints = 5;
    let currentPrints = 0;
    const printGroupsContainer = document.getElementById('printGroupsContainer');
    const addPrintButton = document.getElementById('addPrint');
    const removePrintButton = document.getElementById('removePrint');
    const printFinalPriceInput = document.getElementById('print_final_price');
    const printSumInput = document.getElementById('print_sum');
    const koefsMap = {
        sublimation: pngCalculatorData.sublimationKoefs,
        silkScreen: pngCalculatorData.silkScreenKoefs,
        uvDtf: pngCalculatorData.uvDtfKoefs,
        dtf: pngCalculatorData.dtfKoefs,
    };
    const urgencyKoefs = pngCalculatorData.additionalUrgency

    // Initialize Select2 on all printType and printFormat dropdowns
    function initializeSelect2(group) {

        if (group) {

            $(group.querySelector('.printType')).select2({
                placeholder: 'Оберіть тип друку',
                allowClear: true,
                width: '100%',
                minimumResultsForSearch: Infinity,
            });

            $(group.querySelector('.printFormat')).select2({
                placeholder: 'Оберіть формат',
                allowClear: true,
                width: '100%',
                minimumResultsForSearch: Infinity,
            });


            // Initialize Select2 for the printDiscounts dropdown
            const $discounts = $(group.querySelector('.printDiscounts')).select2({
                placeholder: 'Оберіть знижку',
                allowClear: true,
                width: '100%',
                minimumResultsForSearch: Infinity, // Disable search
            });

            // Attach the event listener for changes in the printDiscounts dropdown
            $discounts.on('change', calculatePrintCosts);

            // Initialize Select2 for the printDiscounts dropdown
            const $discountsprod = $(group.querySelector('.prodDiscounts')).select2({
                placeholder: 'Оберіть знижку',
                allowClear: true,
                width: '100%',
                minimumResultsForSearch: Infinity, // Disable search
            });

            // Attach the event listener for changes in the printDiscounts dropdown
            $discountsprod.on('change', calculateFinalPriceAndSum);
        }

    }

    // Function to populate the format dropdown based on selected type
    function populatePrintFormats(printType, formatSelect) {
        const koefs = koefsMap[printType] || [];
        const $formatSelect = $(formatSelect);
        console.log('koefs', koefs)

        $formatSelect.empty(); // Clear existing options

        koefs.forEach(({ format }) => {
            const option = new Option(format.label, format.value, false, false);
            $formatSelect.append(option);
        });

        $formatSelect.trigger('change'); // Refresh Select2 with new options
    }

    // Function to calculate and update the print costs
    function calculatePrintCosts() {
        const productQuantity = parseInt(productQuantityInput.value) || 0;

        if (productQuantity === 0) {
            printFinalPriceInput.value = '';
            printSumInput.value = '';
            return;
        }

        const printGroups = Array.from(printGroupsContainer.querySelectorAll('.pngcalc__block__group'));
        let totalPrice = 0;

        // Base calculation for print groups
        printGroups.forEach(group => {
            const printType = $(group.querySelector('.printType')).val();
            const printFormat = $(group.querySelector('.printFormat')).val();

            if (!printType || !printFormat) return;

            const koefs = koefsMap[printType] || [];
            const formatData = koefs.find(item => item.format.value === printFormat);

            if (!formatData) return;

            const priceData = formatData.products_price;
            const matchedKoef = priceData.find(priceRange => {
                return (
                    productQuantity >= parseInt(priceRange.quantity_min) &&
                    productQuantity <= parseInt(priceRange.quantity_max)
                );
            });

            if (matchedKoef) {
                totalPrice += parseFloat(matchedKoef.koef);
            }
        });

        const baseFinalPrice = totalPrice.toFixed(2); // Base price per item
        const baseSum = parseFloat((baseFinalPrice * productQuantity).toFixed(2)); // Base sum before discounts or surcharges

        let finalSum = baseSum

        // Apply urgency surcharge if checked
        if(document.getElementById('printUrgency')) {
            let urgencyMultiplier = 1;
            if (document.getElementById('printUrgency').checked) {
                const urgencyKoefs = pngCalculatorData.additionalUrgency;
                const matchedUrgencyKoef = urgencyKoefs.find(range => {
                    return (
                        productQuantity >= parseInt(range.quantity_min) &&
                        productQuantity <= parseInt(range.quantity_max)
                    );
                });

                if (matchedUrgencyKoef) {
                    urgencyMultiplier = parseFloat(matchedUrgencyKoef.quantity_max_copy);
                }
            }

            finalSum = baseSum * urgencyMultiplier; // Apply urgency multiplier to the base sum
        }


        // Apply multipliers for `printClientProduct` and `printDifficulty` checkboxes
        let printClientProduct = document.getElementById('printClientProduct');
        if(document.getElementById('printClientProduct')) {
            const printClientProduct = document.getElementById('printClientProduct').checked
                ? parseFloat(document.getElementById('printClientProduct').value) || 1
                : 1;

            finalSum += baseSum * (printClientProduct - 1); // Adjust for client product multiplier
        }

        if(document.getElementById('printDifficulty')) {
            const printDifficulty = document.getElementById('printDifficulty').checked
                ? parseFloat(document.getElementById('printDifficulty').value) || 1
                : 1;
            finalSum += baseSum * (printDifficulty - 1); // Adjust for difficulty multiplier
        }

        // Apply additional packaging costs if checked
        if(document.getElementById('printPackaging')) {
            const printPackaging = document.getElementById('printPackaging').checked
                ? parseFloat(document.getElementById('printPackaging').value) || 0
                : 0;

            finalSum += printPackaging * productQuantity; // Add packaging costs based on quantity
        }

        // Apply discount
        if(document.querySelector('.printDiscounts')) {
            const printDiscount = parseFloat(document.querySelector('.printDiscounts').value) || 1; // Default to no discount
            finalSum *= printDiscount;
        }




        // Update the final price and sum
        printFinalPriceInput.value = (finalSum / productQuantity).toFixed(2); // Final price per item
        printSumInput.value = parseFloat(finalSum).toFixed(2); // Final total sum

        updateTotalSpans(); // Update spans after recalculating
    }

    // Function to create a new print group
    function createPrintGroup() {
        const template = document.querySelector('.print-group-template');
        const newGroup = template.cloneNode(true);
        newGroup.style.display = '';
        newGroup.classList.remove('print-group-template');

        initializeSelect2(newGroup); // Initialize Select2 for the new group

        const printTypeSelect = newGroup.querySelector('.printType');
        const printFormatSelect = newGroup.querySelector('.printFormat');

        $(printTypeSelect).on('change', function () {
            populatePrintFormats(printTypeSelect.value, printFormatSelect);
            calculatePrintCosts();
        });

        $(printFormatSelect).on('change', calculatePrintCosts);
        productQuantityInput.addEventListener('input', calculatePrintCosts);

        printGroupsContainer.appendChild(newGroup);
        currentPrints++;
    }

    //Sync with clientProductsCheckbox and price_input
    let previousProductPrice = productPriceInput.value; // Store the original price
    const printClientProductCheckbox = document.getElementById('printClientProduct')
    if (printClientProductCheckbox && productPriceInput) {
        // When checkbox is checked, store current price and set product_price to 0
        printClientProductCheckbox.addEventListener('change', function () {
            if (this.checked) {
                previousProductPrice = productPriceInput.value; // Store the price before setting to 0
                productPriceInput.value = 0;
                productPriceInput.dispatchEvent(new Event('input')); // Trigger recalculation
            } else {
                // Restore the previous product price when unchecked
                productPriceInput.value = previousProductPrice;
                productPriceInput.dispatchEvent(new Event('input')); // Trigger recalculation
            }
            calculatePrintCosts();
        });

        // When product_price is changed to a number > 0, uncheck the checkbox
        productPriceInput.addEventListener('input', function () {
            if (parseFloat(this.value) > 0 && printClientProductCheckbox.checked) {
                printClientProductCheckbox.checked = false;
                printClientProductCheckbox.dispatchEvent(new Event('change')); // Trigger recalculation
            }
            calculatePrintCosts();
        });
    }

    //total spans counter
    function updateTotalSpans() {
        const productFinalPrice = parseFloat(productFinalPriceInput.value) || 0;
        const productSum = parseFloat(productSumInput.value) || 0;

        const printFinalPrice = parseFloat(printFinalPriceInput.value) || 0;
        const printSum = parseFloat(printSumInput.value) || 0;

        // Calculate totalPrice and totalSum
        const totalPrice = productFinalPrice + printFinalPrice;
        const totalSum = productSum + printSum;

        // Update spans
        document.getElementById('totalProd').textContent = productSum.toFixed(2);
        document.getElementById('totalPrint').textContent = printSum.toFixed(2);
        document.getElementById('totalPrice').textContent = totalPrice.toFixed(2);
        document.getElementById('totalSum').textContent = totalSum.toFixed(2);
    }

    // Add and Remove print groups
    addPrintButton.addEventListener('click', function (e) {
        e.preventDefault();
        if (currentPrints < maxPrints) {
            createPrintGroup();

        }
    });
    createPrintGroup();

    removePrintButton.addEventListener('click', function (e) {
        e.preventDefault();
        if (currentPrints > 1) {
            const lastGroup = printGroupsContainer.lastElementChild;
            printGroupsContainer.removeChild(lastGroup);
            currentPrints--;
            calculatePrintCosts();
        }
    });

    if(document.querySelector('.printDiscounts')) {
        document.querySelector('.printDiscounts').addEventListener('change', calculatePrintCosts);
    }

    if(document.querySelectorAll('.pngcalc_label.checkbox input[type="checkbox"]')) {
        document.querySelectorAll('.pngcalc_label.checkbox input[type="checkbox"]').forEach(checkbox => {
            checkbox.addEventListener('change', calculatePrintCosts);
        });
    }



    // Initialize on page load
    function initializePrintGroups() {
        const existingGroups = Array.from(document.querySelectorAll('.pngcalc_label.select'));
        // existingGroups.forEach(group => {
        //     initializeSelect2(group); // Initialize Select2 for existing groups
        // });

        initializeSelect2(document.querySelector('.discountGroup'))
        initializeSelect2(document.querySelector('.discountProd'))
    }

    initializePrintGroups();
});

jQuery(document).ready(function($) {
    $('select').on('select2:open', function() {
        $(this).css('pointer-events', 'none'); // Disable native select
    }).on('select2:close', function() {
        $(this).css('pointer-events', 'auto'); // Enable it again
    });
});