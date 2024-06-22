window.addEventListener('load', () => {
    /* STEP 1 */
    const formStep1 = document.querySelector('#loginStep1');
    const email = document.querySelector('#userEmail');
    const password = document.querySelector('#userPassword');

    if (formStep1) {
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

        formStep1.addEventListener('submit', (event) => {
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

            /* Form 1 */
            if (!formStep1.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }

            formStep1.classList.add('was-validated');
        }, false);
    }

    /* STEP 2 */
    const formStep2 = document.querySelector('#loginStep2');
    const code = document.querySelector('#userCode');

    if (formStep2) {
        formStep2.addEventListener('submit', (event) => {
            /* Code */
            if (!validateCode(code.value)) {
                code.setCustomValidity('error');
            } else {
                code.setCustomValidity('');
            }
            
            /* Form 2 */
            if (!formStep2.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
    
            formStep2.classList.add('was-validated');
        }, false);
    }
});