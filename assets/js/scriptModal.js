document.addEventListener('DOMContentLoaded', function () {
    var citaForm = document.getElementById('citaForm');

    if (citaForm) {
        citaForm.addEventListener('submit', function (event) {
            event.preventDefault(); // Evitar que el formulario se envíe de forma predeterminada

            // Obtener los valores del formulario
            var motivoCitaElement = document.getElementById('motivo');
            var medicoSeleccionadoElement = document.querySelector('input[name="medico"]:checked');

            if (medicoSeleccionadoElement) {
                if (motivoCitaElement && motivoCitaElement.value.trim() !== "") {
                    var motivoCita = motivoCitaElement.value;
                    var medicoSeleccionado = medicoSeleccionadoElement.value;

                    abrirCalendario();

                    // Almacena las variables como propiedades globales del objeto 'window'
                    window.motivoCita = motivoCita;
                    window.medicoSeleccionado = medicoSeleccionado;

                    // Desplegar el calendario (mostrar el div con id "hjsCalendar")
                    document.getElementById('hjsCalendar').style.display = 'block';

                    var divCliente = document.getElementById('comparar-valores');

                    // Limpiar el contenido anterior
                    divCliente.innerHTML = '';
                } else {
                    var modalFooter = document.querySelector('.pre-calendar-footer');
                    modalFooter.style.textAlign = 'left';

                    var divCliente = document.getElementById('comparar-valores');

                    // Limpiar el contenido anterior
                    divCliente.innerHTML = '';

                    var contenidoError = document.createElement('h4');
                    contenidoError.innerHTML = '<strong>Tienes que completar el campo del motivo.</strong>';
                    contenidoError.style.color = 'red';

                    // Asegúrate de que el contenido se posicione a la izquierda
                    divCliente.style.textAlign = 'left';

                    divCliente.appendChild(contenidoError);
                }
            } else {
                var modalFooter = document.querySelector('.pre-calendar-footer');
                modalFooter.style.textAlign = 'left';

                var divCliente = document.getElementById('comparar-valores');

                // Limpiar el contenido anterior
                divCliente.innerHTML = '';

                var contenidoError = document.createElement('h4');
                contenidoError.innerHTML = '<strong>Tienes que seleccionar un médico.</strong>';
                contenidoError.style.color = 'red';

                // Asegúrate de que el contenido se posicione a la izquierda
                divCliente.style.textAlign = 'left';

                divCliente.appendChild(contenidoError);
            }
        });
    }
});


/* d */
function abrirCalendario() {
    // Oculta el contenido previo
    document.getElementById("pre-calendar").style.display = "none";
    document.getElementById("calendar").style.display = "block";

    // Genera el calendario utilizando hjsCalendar
    hjsCalendar(document.getElementById('hjsCalendar'));
}

function volverFormulario() {
    // Oculta el contenido previo
    document.getElementById("pre-calendar").style.display = "block";

    // Muestra el calendario
    document.getElementById("calendar").style.display = "none";

}

// Función para reiniciar la selección al abrir el modal
function reiniciarSeleccion() {
    // Restablece la visibilidad de la dropdown
    document.getElementById("medicosDropdown").style.display = "block";

    // Muestra el botón
    document.getElementById("seleccionarMedicoBtn").style.display = "inline";

    // Restablece la variable de ID del médico seleccionado
    idMedicoSeleccionado = null;
}

// Funcion para recargar la pagina.
function recargarPagina() {
    // Recargar la página
    location.reload();
}