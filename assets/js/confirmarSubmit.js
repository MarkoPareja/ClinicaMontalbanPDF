$(document).ready(function () {
    // Deshabilitar el botón al cargar la página
    $('button[type="submit"]').prop('disabled', true);

    // Habilitar/deshabilitar el botón cuando el checkbox cambia
    $('#gridCheck').change(function () {
        if ($(this).is(':checked')) {
            $('button[type="submit"]').prop('disabled', false);
        } else {
            $('button[type="submit"]').prop('disabled', true);
        }
    });
});