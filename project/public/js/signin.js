window.addEventListener('load', () => {
    const form = document.querySelector('.needs-validation');
    const email = document.querySelector('#userEmail');
    const password = document.querySelector('#userPassword');

    /* Email */
    email.addEventListener('focusout', (event) => {
        if (!validateEmail(email.value)) {
            email.setCustomValidity('error');
        } else {
            email.setCustomValidity('');
        }
    });

    /* Password */
    password.addEventListener('focusout', (event) => {
        if (password.value == '') {
            password.setCustomValidity('error');
        } else {
            password.setCustomValidity('');
        }
    });

    form.addEventListener('submit', (event) => {
        /* Email */
        if (!validateEmail(email.value)) {
            email.setCustomValidity('error');
        } else {
            email.setCustomValidity('');
        }

        /* Password */
        if (password.value == '') {
            password.setCustomValidity('error');
        } else {
            password.setCustomValidity('');
        }

        /* Form */
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }

        form.classList.add('was-validated');
    }, false);
});