const validatePassword = (password) => {
    var allValid = [];

    const lowercasePattern = /^(?=.*[a-z]).+$/;
    const uppercasePattern = /^(?=.*[A-Z]).+$/;
    const numbersPattern = /^(?=.*[0-9]).+$/;
    const specialCharsPattern = /^(?=.*[!@#\$%\^\&*\)\(+=._-]).+$/;
    const emojiPattern = /[\p{Extended_Pictographic}\u{1F3FB}-\u{1F3FF}\u{1F9B0}-\u{1F9B3}]/u;

    const lengthLabel = document.querySelector('#pwdCheckLength');
    const lowercaseLabel = document.querySelector('#pwdCheckLower');
    const uppercaseLabel = document.querySelector('#pwdCheckUpper');
    const numbersLabel = document.querySelector('#pwdCheckNumber');
    const specialCharsLabel = document.querySelector('#pwdCheckSpecial');
    const spaceLabel = document.querySelector('#pwdCheckSpace');
    const emojiLabel = document.querySelector('#pwdCheckEmoji');
    const nameLabel = document.querySelector('#pwdCheckName');

    const userName = document.querySelector('#userName').value;

    if (password.length >= 12) {
        lengthLabel.classList.add('checked');
        allValid.push(true);
    } else {
        lengthLabel.classList.remove('checked');
        allValid.push(false);
    }

    if(lowercasePattern.test(password)) {
        lowercaseLabel.classList.add('checked');
        allValid.push(true);
    } else {
        lowercaseLabel.classList.remove('checked');
        allValid.push(false);
    }

    if(uppercasePattern.test(password)) {
        uppercaseLabel.classList.add('checked');
        allValid.push(true);
    } else {
        uppercaseLabel.classList.remove('checked');
        allValid.push(false);
    }

    if(numbersPattern.test(password)) {
        numbersLabel.classList.add('checked');
        allValid.push(true);
    } else {
        numbersLabel.classList.remove('checked');
        allValid.push(false);
    }

    if(specialCharsPattern.test(password)) {
        specialCharsLabel.classList.add('checked');
        allValid.push(true);
    } else {
        specialCharsLabel.classList.remove('checked');
        allValid.push(false);
    }

    if(password.indexOf(' ') == -1) {
        spaceLabel.classList.remove('not-checked');
        allValid.push(true);
    } else {
        spaceLabel.classList.add('not-checked');
        allValid.push(false);
    }

    if(emojiPattern.test(password)) {
        emojiLabel.classList.add('not-checked');
        allValid.push(false);
    } else {
        emojiLabel.classList.remove('not-checked');
        allValid.push(true);
    }

    if(password.indexOf(userName) == -1) {
        nameLabel.classList.remove('not-checked');
        allValid.push(true);
    } else {
        nameLabel.classList.add('not-checked');
        allValid.push(false);
    }

    if (allValid.indexOf(false) == -1) {
        return true;
    }
    return false;
};

window.addEventListener('load', () => {
    const form = document.querySelector('.needs-validation');
    const email = document.querySelector('#userEmail');
    const password = document.querySelector('#userPassword');
    const repeatedPassword = document.querySelector('#repeatedPassword');

    const captchaWidget = document.querySelector('#altcha');
    const captchaPayload = document.getElementsByName('altcha');
    const captchaError = document.querySelector('.captcha .invalid-feedback');

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
        if (!validatePassword(password.value)) {
            password.setCustomValidity('error');
        } else {
            password.setCustomValidity('');
        }
    });

    /* Repeated password */
    repeatedPassword.addEventListener('focusout', (event) => {
        if (password.value != repeatedPassword.value) {
            repeatedPassword.setCustomValidity('error');
        } else {
            repeatedPassword.setCustomValidity('');
        }
    });

    /* Captcha */
    captchaWidget.addEventListener('statechange', (event) => {
        if (captchaError.classList.contains('d-block') && event.detail.state !== 'verified') {
            captchaError.classList.add('d-block');
        } else {
            captchaError.classList.remove('d-block');
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

        /* Captcha */
        if (captchaPayload.length == 0) {
            captchaError.classList.add('d-block');
        } else {
            captchaError.classList.remove('d-block');
        }
        
        /* Form */
        if (!form.checkValidity() || captchaPayload.length == 0) {
            event.preventDefault();
            event.stopPropagation();
        }

        form.classList.add('was-validated');
    }, false);

});