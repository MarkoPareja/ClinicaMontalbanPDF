hjsCalendar(function (confirmTime) {
    // Contenido de tu base de datos o lógica aquí

    // Aquí puedes mostrar un mensaje en el modal-footer
    this.confirmTime(confirmTime);
});

this.confirmTime = (hora) => {
    if (eventos[hora] > 2) {
        // Mostrar "Realizada con éxito" en el modal-footer
        let modalFooter = document.querySelector(".modal-footer");
        modalFooter.innerHTML = "<p>Realizada con éxito</p>";
    } else {
        // Mostrar un mensaje en el modal-footer si no se cumple la condición
        let modalFooter = document.querySelector(".modal-footer");
        modalFooter.innerHTML = "<p>No se pudo realizar la acción.</p>";
        eventos[hora]++;
    }
}
