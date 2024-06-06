const validateEmail = (email) => {
    const result = String(email)
        .toLowerCase()
        .match(
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        );
    
    if (result != null) {
        return true;
    }
    return false;
};

const validatePassword = (password) => {
    const lowercasePattern = /^(?=.*[a-z]).+$/;
    const uppercasePattern = /^(?=.*[A-Z]).+$/;
    const numbersPattern = /^(?=.*[0-9]).+$/;
    const specialCharsPattern = /^(?=.*[!@#\$%\^\&*\)\(+=._-]).+$/;
    const spacePattern = /^\s+$/;

    //if (password.length >= 12) {
        if(lowercasePattern.test(password)) {
            if(uppercasePattern.test(password)) {
                if(numbersPattern.test(password)) {
                    if(specialCharsPattern.test(password)) {
                        console.log(spacePattern.test(password));
                        return true;
                        /*if(!spacePattern.test(password)) {
                            return true;
                        }*/
                    }
                }
            }
        }
    //}
    return false;
};

document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector('.needs-validation');
    const email = document.querySelector('#userEmail');
    const password = document.querySelector('#userPassword');
    const repeatedPassword = document.querySelector('#repeatedPassword');

    form.addEventListener('submit', (event) => {
        /* Email */
        if (!validateEmail(email.value)) {
            email.setCustomValidity('error');
        } else {
            email.setCustomValidity('');
        }

        /* Password */
        if (!validatePassword(password.value)) {
            password.setCustomValidity('error');
        } else {
            password.setCustomValidity('');
        }

        /* Repeated password */
        if (password.value != repeatedPassword.value) {
            repeatedPassword.setCustomValidity('error');
        } else {
            repeatedPassword.setCustomValidity('');
        }
        
        /* Form */
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }

        form.classList.add('was-validated');
      }, false);

});