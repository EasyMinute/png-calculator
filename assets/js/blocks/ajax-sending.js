document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('png-calculator-form'); // Replace with your form's ID
    if (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(form);
            const totalPrice = document.getElementById('totalPrice')?.textContent.trim() || '0';
            const totalSum = document.getElementById('totalSum')?.textContent.trim() || '0';

            // Append them to FormData
            formData.append('totalPrice', totalPrice);
            formData.append('totalSum', totalSum);

            // Extract values from dynamically created selects
            const printFormats = [];
            const printTypes = [];

            document.querySelectorAll('.printFormat').forEach(select => {
                printFormats.push(select.value);
            });

            document.querySelectorAll('.printType').forEach(select => {
                printTypes.push(select.value);
            });

            // Append to FormData as arrays
            formData.append('printFormats', JSON.stringify(printFormats));
            formData.append('printTypes', JSON.stringify(printTypes));

            const xhr = new XMLHttpRequest();

            // Adding a special parameter 'action' to indicate which action to call
            formData.append('action', 'send_to_crm_action');

            // Debugging
            console.log('FormData:', Object.fromEntries(formData.entries()));

            xhr.open('POST', ajaxurl, true); // WordPress automatically provides `ajaxurl` in admin.
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // alert('Форму надіслано!');
                    console.log('CRM data sent successfully:', xhr.responseText);
                    // **Clear all form fields**
                    form.reset();

                    // **Clear dynamically created selects**
                    document.querySelectorAll('.printFormat, .printType').forEach(select => {
                        select.value = '';
                    });
                    // **Clear displayed total price & total sum (if necessary)**
                    if (document.getElementById('totalPrice')) {
                        document.getElementById('totalPrice').textContent = '0';
                    }
                    if (document.getElementById('totalSum')) {
                        document.getElementById('totalSum').textContent = '0';
                    }
                    document.querySelectorAll('.pngcalc__step').forEach(stepElement => {
                        stepElement.classList.add('hidden');
                    });
                    const targetStep = document.querySelector(`.pngcalc__step[data-step="final"]`);
                    targetStep.classList.remove('hidden');
                } else if (xhr.readyState === 4) {
                    alert('Помилка надсилання');
                    console.error('Error sending data to CRM:', xhr.status, xhr.statusText);
                }
            };

            xhr.send(formData);
        });
    }
});
