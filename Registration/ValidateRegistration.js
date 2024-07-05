

        document.getElementById('signupForm').addEventListener('submit', function(event) {
            const inputs = document.querySelectorAll('#signupForm input');
            let valid = true;
            inputs.forEach(input => {
                if (!input.checkValidity()) {
                    valid = false;
                }
            });
            if (!valid) {
                event.preventDefault();
            }
        });
        document.addEventListener('DOMContentLoaded', function () {
            var errorMessage = "<?php echo addslashes($error_message); ?>";
            if (errorMessage.length > 0) {
                document.getElementById('modalErrorMessage').textContent = errorMessage;
                document.getElementById('errorModal').showModal();
            }
        });

    function showError(fieldId, message) {
        const errorElement = document.getElementById(`${fieldId}-error`);
        errorElement.innerText = message;
        errorElement.style.display = 'block';
    }

    function hideError(fieldId) {
        const errorElement = document.getElementById(`${fieldId}-error`);
        errorElement.style.display = 'none';
    }

    function validateField(fieldId, validator, errorMessage) {
        const field = document.getElementById(fieldId);
        field.addEventListener('blur', function() {
            if (!validator(field.value)) {
                showError(fieldId, errorMessage);
            } else {
                hideError(fieldId);
            }
        });
    }

    validateField('fname', value => /^[a-zA-Z]+$/.test(value), 'First name should not contain numbers.');
    validateField('lname', value => /^[a-zA-Z]+$/.test(value), 'Last name should not contain numbers.');
    validateField('number', value => /^\d{11}$/.test(value), 'Mobile number must be 11 digits.');
    validateField('password', value => value.length >= 6, 'Password must be at least 6 characters long.');
    validateField('cpassword', value => value === document.getElementById('password').value, 'Passwords do not match.');
    validateField('cpassword', value => value === document.getElementById('password').value, 'Passwords do not match.');
    validateField('nid', value => /^\d{10}$|^\d{13}$|^\d{17}$/.test(value), 'Provide correct NID Number');
    validateField('postal', value => /^\d+$/.test(value), 'Postal code should be numeric.');


   
    document.getElementById('signupForm').addEventListener('submit', function(event) {
        const fname = document.getElementById('fname').value;
        const lname = document.getElementById('lname').value;
        const number = document.getElementById('number').value;
        const password = document.getElementById('password').value;
        const cpassword = document.getElementById('cpassword').value;
        const nid = document.getElementById('nid').value;
        const postal = document.getElementById('postal').value;
        const ownPicture = document.getElementById('own-picture').files[0];
        const nidPicture = document.getElementById('nid-picture').files[0];

        const nameRegex = /^[a-zA-Z]+$/;
        const numberRegex = /^\d{11}$/;

        if (!nameRegex.test(fname) || !nameRegex.test(lname)) {
            alert('Names should not contain numbers.');
            event.preventDefault();
            return false;
        }

        if (!numberRegex.test(number)) {
            alert('Mobile number must be 11 digits.');
            event.preventDefault();
            return false;
        }

        if (password.length < 6) {
            alert('Password must be at least 6 characters long.');
            event.preventDefault();
            return false;
        }

        if (password !== cpassword) {
            alert('Passwords do not match.');
            event.preventDefault();
            return false;
        }
        // Validate NID number
        if (!/^\d{10}$|^\d{13}$|^\d{17}$/.test(nid)) {
            event.preventDefault();
            document.getElementById('nid-error').style.display = 'block';
        } else {
            document.getElementById('nid-error').style.display = 'none';
        }

        // Validate postal code
        if (!/^\d+$/.test(postal)) {
            event.preventDefault();
            document.getElementById('postal-error').style.display = 'block';
        } else {
            document.getElementById('postal-error').style.display = 'none';
        }

        // Validate your picture
        if (!ownPicture) {
            event.preventDefault();
            document.getElementById('own-picture-error').style.display = 'block';
        } else {
            document.getElementById('own-picture-error').style.display = 'none';
        }
        // Validate NID picture
        if (!nidPicture) {
            event.preventDefault();
            document.getElementById('nid-picture-error').style.display = 'block';
        } else {
            document.getElementById('nid-picture-error').style.display = 'none';
        }
    });

    function togglePasswordVisibility(id, svg) {
        const input = document.getElementById(id);
        if (input.type === "password") {
            input.type = "text";
            svg.setAttribute("fill", "#007bff");
        } else {
            input.type = "password";
            svg.setAttribute("fill", "#bbb");
        }
    }
    function togglePasswordVisibility(id, eyeIcon) {
        const input = document.getElementById(id);
        if (input.type === 'password') {
            input.type = 'text';
            eyeIcon.setAttribute('fill', '#666');
        } else {
            input.type = 'password';
            eyeIcon.setAttribute('fill', '#bbb');
        }
    }

   

