/* Aqui creamos un evento en click que cuando clickemos el icono pasaremos
 el tipo de campo de pasword a texto para visualizar el contenido(la contraseña)*/

const passwordFieldReset = document.getElementById("password-field-reset");
const togglePasswordReset = document.getElementById("toggle-password-reset");

togglePasswordReset.addEventListener("click", () => {
    if (passwordFieldReset.type === "password") {
        passwordFieldReset.type = "text";
        togglePasswordReset.innerHTML = "<i class='bx bx-show'></i>";
    } else {
        passwordFieldReset.type = "password";
        togglePasswordReset.innerHTML = "<i class='bx bxs-hide'></i>";
    }
});

/* Duplicamos ya que tenemos dos campos de contraseña */

const passwordFieldReset2 = document.getElementById("password-field-reset2");
const togglePasswordReset2 = document.getElementById("toggle-password-reset2");

togglePasswordReset2.addEventListener("click", () => {
    if (passwordFieldReset2.type === "password") {
        passwordFieldReset2.type = "text";
        togglePasswordReset2.innerHTML = "<i class='bx bx-show'></i>";
    } else {
        passwordFieldReset2.type = "password";
        togglePasswordReset2.innerHTML = "<i class='bx bxs-hide'></i>";
    }
});

/* Esta funcion recoge las dos contraseñas al enviarlas con el submit, en el caso de que no coincidan salte error. */
function validarContraseñas() {
    var contraseña1 = document.getElementById("password-field-reset").value;
    var contraseña2 = document.getElementById("password-field-reset2").value;
    var mensajeError = document.getElementById("mensajeError");
    var inputContraseña1 = document.getElementById("password-field-reset");
    var inputContraseña2 = document.getElementById("password-field-reset2");

    if (contraseña1 !== contraseña2) {
        mensajeError.style.display = "block";
        // Limpiar los campos de contraseña si no coinciden
        inputContraseña1.value = "";
        inputContraseña2.value = "";




    } else {
        mensajeError.style.display = "none";
        document.getElementById("resetForm").submit();
    }
}



