/* Aquí tenemos una funcion que es un temporizador que lo utilizamos para la recuperacion de contraseña
    ya que una vez carue la pagina el token expira en 15 min. Asi podemos printar una cuenta regresiva para que
    el cliente pueda tenerlo en cuenta. */
var tiempoRestante = 15 * 60;

function actualizarCuentaAtras() {
    var minutos = Math.floor(tiempoRestante / 60);
    var segundos = tiempoRestante % 60;

    minutos = minutos < 10 ? "0" + minutos : minutos;
    segundos = segundos < 10 ? "0" + segundos : segundos;

    document.getElementById("countdown").innerHTML = "Cuenta atrás: " + minutos + ":" + segundos;

    tiempoRestante--;

    if (tiempoRestante >= 0) {
        setTimeout(actualizarCuentaAtras, 1000); // Actualizar cada segundo
    } else {
        // Mostrar el mensaje de código de verificación expirado
        document.getElementById("countdown").style.display = "none";
        document.getElementById("codigoExpirado").style.display = "block";
    }
}

window.onload = function () {
    actualizarCuentaAtras();
};