
/* Esta funcion se asegura que compruebe si se ha equivocado el cliente en introducir los datos. */
document.addEventListener('DOMContentLoaded', function () {
    // Verificar si hay un parámetro de error en la URL

    var urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('error') && urlParams.get('error') === '1') {
        // Ejecutar la función actualizarMensajeError()
        actualizarMensajeError();
    }
});

// Asegúrate de que esta función esté definida antes de su uso
function actualizarMensajeError() {

    document.getElementById("error-cuenta").innerHTML = '<br><p style="color: red; font-weight: bold;">Usuario no existe.</p><p style="color: red; font-weight: bold;">Por favor verifique los datos introducidos.</p>';
}

/* Aquí creamos las variables y le indicamos con que ID esta trabajando,
 tambien con la clase que es el "query". */
const btnSignIn = document.getElementById("sign-in"),
    btnSignUp = document.getElementById("sign-up"),
    btnRecovery = document.getElementById("recovery-link"),
    formRegister = document.querySelector(".register"),
    formLogin = document.querySelector(".login"),
    formRecovery = document.querySelector(".recovery"),
    formBack = document.querySelector(".back");

/* |||| Formularios |||| 
Esta sección contiene los formularios para el inicio de sesión, registro y recuperación de contraseña.
Cada formulario está encapsulado en su contenedor respectivo.
Los formularios se muestran o se ocultan según las interacciones del usuario con los botones correspondientes.
Se utilizan transiciones de animación para crear una experiencia de usuario agradable al cambiar entre formularios. */

btnRecovery.addEventListener("click", e => {
    fadeOut(formLogin, function () {
        formLogin.classList.add("hide");
        formRecovery.classList.remove("hide-recovery");
        formLogin.style.visibility = "hidden"; // Oculta el elemento
        formRecovery.style.visibility = "visible"; // Asegura que el elemento esté visible
        fadeIn(formRecovery);
    });
});


btnSignIn.addEventListener("click", e => {
    fadeOut(formLogin, function () {
        formRegister.classList.add("hide");
        formLogin.classList.remove("hide");
        formRegister.style.visibility = "hidden";
        formLogin.style.visibility = "visible";
        fadeIn(formLogin);
    });
});

btnSignUp.addEventListener("click", e => {
    fadeOut(formLogin, function () {
        formLogin.classList.add("hide");
        formRegister.classList.remove("hide");
        formLogin.style.visibility = "hidden";
        formRegister.style.visibility = "visible";
        fadeIn(formRegister);
    });
});

function fadeIn(element) {
    element.style.opacity = 0.15;

    (function fade() {
        var val = parseFloat(element.style.opacity);
        val += 0.73;
        element.style.opacity = val;

        if (val < 1) {
            requestAnimationFrame(fade);
        }
    })();
}

function fadeOut(element, callback) {
    element.style.opacity = 1;

    (function fade() {
        var val = parseFloat(element.style.opacity);
        val -= 0.10;

        element.style.opacity = val;

        if (val > 0) {
            requestAnimationFrame(fade);
        } else {
            if (typeof callback === "function") {
                callback();
            }
        }
    })();
}

/* Aqui creamos un evento en click que cuando clickemos el icono pasaremos
 el tipo de campo de pasword a texto para visualizar el contenido(la contraseña)*/
const passwordField = document.getElementById("password-field");
const togglePassword = document.getElementById("toggle-password");

togglePassword.addEventListener("click", () => {
    if (passwordField.type === "password") {
        passwordField.type = "text";
        togglePassword.innerHTML = "<i class='bx bx-show'></i>";
    } else {
        passwordField.type = "password";
        togglePassword.innerHTML = "<i class='bx bxs-hide'></i>";
    }
});

/* Aqui hace exatamente lo mismo, pero es la parte del Login, a diferencia de la
  otra que era registro. */
const passwordFieldlogin = document.getElementById("password-field-login");
const togglePasswordlogin = document.getElementById("toggle-password-login");

togglePasswordlogin.addEventListener("click", () => {
    if (passwordFieldlogin.type === "password") {
        passwordFieldlogin.type = "text";
        togglePasswordlogin.innerHTML = "<i class='bx bx-show'></i>";
    } else {
        passwordFieldlogin.type = "password";
        togglePasswordlogin.innerHTML = "<i class='bx bxs-hide'></i>";
    }
});

/* Esta función limita la longitud del valor en el campo
 de entrada de teléfono a un máximo de 9 caracteres. */
const phoneInput = document.getElementById("phone-input");

phoneInput.addEventListener("input", function () {
    const maxLength = 9;
    // Eliminar caracteres que no son dígitos
    phoneInput.value = phoneInput.value.replace(/\D/g, '');
    // Limitar la longitud a 9 dígitos
    if (phoneInput.value.length > maxLength) {
        phoneInput.value = phoneInput.value.slice(0, maxLength);
    }
});

/* Función para bloquear y desbloquear el scroll */
function blockScroll() {
    document.body.classList.add("scroll-blocked");
}

function unblockScroll() {
    document.body.classList.remove("scroll-blocked");
}

/* Función que detecta la rueda del mouse 
y desenfoca los elementos numéricos con la clase "noscroll". */
document.addEventListener("wheel", function (event) {
    if (document.activeElement.type === "number" &&
        document.activeElement.classList.contains("noscroll")) {
        document.activeElement.blur();
    }
});

/* Aquí tenemos una unción que valida la edad del usuario 
    basada en la fecha de nacimiento "date-input", "age-error". */
const dateInput = document.getElementById("date-input");
const ageError = document.getElementById("age-error");

dateInput.addEventListener("change", function () {
    const selectedDate = new Date(dateInput.value);
    const today = new Date();
    const age = today.getFullYear() - selectedDate.getFullYear();

    if (age < 18) {
        ageError.style.display = "block";
        dateInput.setCustomValidity("Debes ser mayor de 18 años.");
    } else {
        ageError.style.display = "none";
        dateInput.setCustomValidity("");
    }
});

