document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');

    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            if (!validateLoginForm()) {
                e.preventDefault();
            }
        });
    }

    if (registerForm) {
        registerForm.addEventListener('submit', function(e) {
            if (!validateRegisterForm()) {
                e.preventDefault();
            }
        });
    }

    function validateLoginForm() {
        let isValid = true;
        
        const username = document.getElementById('username');
        const password = document.getElementById('password');
        
        // Limpiar errores previos
        clearErrors();
        
        // Validar usuario
        if (username.value.trim() === '') {
            showError('username', 'El usuario es requerido');
            isValid = false;
        }
        
        // Validar contraseña
        if (password.value.trim() === '') {
            showError('password', 'La contraseña es requerida');
            isValid = false;
        }
        
        return isValid;
    }

    function validateRegisterForm() {
        let isValid = true;
        
        const username = document.getElementById('username');
        const email = document.getElementById('email');
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirm_password');
        
        // Limpiar errores previos
        clearErrors();
        
        // Validar usuario
        if (username.value.trim() === '') {
            showError('username', 'El usuario es requerido');
            isValid = false;
        } else if (username.value.trim().length < 3) {
            showError('username', 'El usuario debe tener al menos 3 caracteres');
            isValid = false;
        }
        
        // Validar email
        if (email.value.trim() === '') {
            showError('email', 'El email es requerido');
            isValid = false;
        } else if (!isValidEmail(email.value.trim())) {
            showError('email', 'Ingrese un email válido');
            isValid = false;
        }
        
        // Validar contraseña
        if (password.value.trim() === '') {
            showError('password', 'La contraseña es requerida');
            isValid = false;
        } else if (password.value.length < 6) {
            showError('password', 'La contraseña debe tener al menos 6 caracteres');
            isValid = false;
        }
        
        // Validar confirmación de contraseña
        if (confirmPassword && confirmPassword.value.trim() === '') {
            showError('confirm_password', 'Confirme la contraseña');
            isValid = false;
        } else if (confirmPassword && password.value !== confirmPassword.value) {
            showError('confirm_password', 'Las contraseñas no coinciden');
            isValid = false;
        }
        
        return isValid;
    }

    function showError(fieldName, message) {
        const field = document.getElementById(fieldName);
        const errorDiv = document.createElement('div');
        errorDiv.className = 'error';
        errorDiv.textContent = message;
        
        field.parentNode.appendChild(errorDiv);
        field.style.borderColor = '#dc3545';
    }

    function clearErrors() {
        const errors = document.querySelectorAll('.error');
        errors.forEach(error => error.remove());
        
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
            input.style.borderColor = '#ddd';
        });
    }

    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
});