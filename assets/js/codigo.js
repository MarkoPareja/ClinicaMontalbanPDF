// script.js
$(document).ready(function () {
    $("#recuperar").click(function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "php/recuperacion_be.php",
            data: $(".form").serialize(),
            success: function (response) {
                if (response === 'Correo enviado correctamente') {
                    // Muestra el modal automáticamente al obtener una respuesta exitosa del servidor
                    $("#codigoModal").modal("show");
                } else {
                    console.log(response);
                }
            },
            error: function (error) {
                console.log("Error en la solicitud Ajax: " + error);
            }
        });
    });

    $("#codigoForm").submit(function (e) {
        e.preventDefault();

        alert("Código verificado con éxito. Redirigiendo...");
        window.location.href = "../login.php";
    });
});

