
/*  Esta función permite borrar una cita gracias a que recoge el "idCita" en el hjsCalendar.
    este manda la solicitud "POST" borrarCita.php, gracias a esta funcion podemos borrarla segun el ID que mandamos.
    ademas de esconder el modal para hacer la transicion. */

function borrarCita(idCita) {

    var confirmacionModal = new bootstrap.Modal(document.getElementById('confirmacionModal'));

    document.getElementById('confirmacionMensaje').innerHTML = "¿Estás seguro de que quieres borrar esta cita?";
    confirmacionModal.show();

    document.getElementById('confirmarEliminar').addEventListener('click', function() {
        // Realizar la eliminación mediante AJAX mandando la peticion al borrarCita.php
        var xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById('generarVisitas').innerHTML = '';
                document.getElementById('generarVisitas').innerHTML = generarVisitas();
            }
        };

        xhr.open("POST", "php/borrarCita.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("idCita=" + idCita);

        // Cerrar el modal de confirmación después de hacer clic en 'Eliminar'.
        confirmacionModal.hide();
    });
}
