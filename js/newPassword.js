const formulario = document.getElementById('formRecuperarPassword');
const inputPassword = document.querySelector('#new_password');

const expresionPassword = /^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{6,20}$/;

const validarPassword = (e) => {
    if (expresionPassword.test(inputPassword.value)) {
        document.getElementById('grupo-new_password').classList.remove('formulario-grupo-incorrecto');
        document.getElementById('grupo-new_password').classList.add('formulario-grupo-correcto');
        document.querySelector('#grupo-new_password i').classList.add('fa-check-circle');
        document.querySelector('#grupo-new_password i').classList.remove('fa-times-circle');
        document.querySelector('#grupo-new_password .formulario-input-error').classList.remove('formulario-input-error-activo');
    } else {
        document.getElementById('grupo-new_password').classList.add('formulario-grupo-incorrecto');
        document.getElementById('grupo-new_password').classList.remove('formulario-grupo-correcto');
        document.querySelector('#grupo-new_password i').classList.add('fa-times-circle');
        document.querySelector('#grupo-new_password i').classList.remove('fa-check-circle');
        document.querySelector('#grupo-new_password .formulario-input-error').classList.add('formulario-input-error-activo');
    }
};

// Validar en tiempo real
inputPassword.addEventListener('keyup', validarPassword);
inputPassword.addEventListener('blur', validarPassword);
