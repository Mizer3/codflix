const registration = document.getElementById('registrationForm');

function registerForm(e) {
    

    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const passwordConfirm = document.getElementById('password_confirm');
    const invalidEmail = document.getElementsByClassName('invalid-email');
    const invalidPassword = document.getElementsByClassName('invalid-password');
    const invalidPasswordConfirm = document.getElementsByClassName('invalid-password-confirm');


    if (email.value === '') {
        email.style.border = '1px solid red';
        invalidEmail[0].style.display = 'block';
        e.preventDefault();
    }
    if (password.value === '') {
        password.style.border = '1px solid red';
        invalidPassword[0].style.display = 'block';
        e.preventDefault();
    }
    if (password.value.length < 6) {
        password.style.border = '1px solid red';
        invalidPassword[0].style.display = 'block';
        e.preventDefault();
    }

    if (password.value !== passwordConfirm.value) {
        password.style.border = '1px solid red';
        passwordConfirm.style.border = '1px solid red';
        invalidPasswordConfirm[0].style.display = 'block';
        e.preventDefault();
    }
}

registration.addEventListener('submit', registerForm);