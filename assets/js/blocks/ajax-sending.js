// document.addEventListener('DOMContentLoaded', function () {
//     const form = document.getElementById('crm-form'); // Replace 'crm-form' with your form's ID
//     form.addEventListener('submit', function (e) {
//         e.preventDefault();
//
//         const formData = new FormData(form);
//         const xhr = new XMLHttpRequest();
//
//         xhr.open('POST', '/path-to-your-php-handler.php', true); // Update the path to your PHP handler
//         xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
//
//         xhr.onreadystatechange = function () {
//             if (xhr.readyState === 4 && xhr.status === 200) {
//                 console.log('CRM data sent successfully:', xhr.responseText);
//             } else if (xhr.readyState === 4) {
//                 console.error('Error sending data to CRM:', xhr.status, xhr.statusText);
//             }
//         };
//
//         xhr.send(formData);
//     });
// });
