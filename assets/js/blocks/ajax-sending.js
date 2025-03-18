document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('png-calculator-form'); // Replace with your form's ID
    if (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(form);
            const totalPrice = document.getElementById('totalPrice')?.textContent.trim() || '0';
            const totalSum = document.getElementById('totalSum')?.textContent.trim() || '0';
            const formInputs = form.querySelectorAll('input')
            const formLoading = form.querySelector('#png-calculator__loading')

            if ([...formInputs].some(input => input.classList.contains('invalid'))) {
                console.log("Form has invalid fields. Stopping AJAX.");
                return; // Stop the function
            }


            grecaptcha
            if (grecaptcha.getResponse() === "") {
                e.preventDefault();
                alert("Будь ласка, заповніть рекапчу!");
                return
            }

            formLoading.classList.add('active')

            // ✅ Append reCAPTCHA response to FormData
            formData.append('g-recaptcha-response', recaptchaResponse);
            // ✅✅✅✅Need to complete backend
            // Append them to FormData
            formData.append('totalPrice', totalPrice);
            formData.append('totalSum', totalSum);

            // Extract values from dynamically created selects
            const printFormats = [];
            const printTypes = [];

            document.querySelectorAll('.printFormat.select2-hidden-accessible').forEach(select => {
                printFormats.push(select.value);
                console.log('select', select)
            });

            document.querySelectorAll('.printType.select2-hidden-accessible').forEach(select => {
                printTypes.push(select.value);
            });

            // Append to FormData as arrays
            formData.append('printFormats', JSON.stringify(printFormats));
            formData.append('printTypes', JSON.stringify(printTypes));

            const xhr = new XMLHttpRequest();

            // Append files
            const fileInput = document.querySelector('#calc_print_files');
            if (fileInput && fileInput.files.length > 0) {
                for (let i = 0; i < fileInput.files.length; i++) {
                    formData.append(`attachments[]`, fileInput.files[i]);
                }
            }

            // Adding a special parameter 'action' to indicate which action to call
            formData.append('action', 'send_to_crm_action');

            // Debugging
            console.log('FormData:', Object.fromEntries(formData.entries()));

            xhr.open('POST', ajaxurl, true); // WordPress automatically provides `ajaxurl` in admin.
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

            xhr.onreadystatechange = function () {
                formLoading.classList.remove('active')

                if (xhr.readyState === 4 && xhr.status === 200) {
                    // alert('Форму надіслано!');
                    console.log('CRM data sent successfully:', xhr.responseText);
                    // **Clear all form fields**
                    // form.reset();
                    document.querySelectorAll('.pngcalc_label input').forEach(input => {
                        input.value = '';
                    });

                    // **Clear dynamically created selects**
                    // document.querySelectorAll('.printFormat, .printType').forEach(select => {
                    //     select.value = '';
                    // });
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
                    console.log('xhr', xhr)
                }
            };

            xhr.send(formData);
        });
    }
});
