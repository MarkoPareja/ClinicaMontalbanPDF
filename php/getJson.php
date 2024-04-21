
<?php
// Tu código PHP aquí
session_start();
include 'conexion_be.php';


$query = "SELECT idTrabajador,fecha, HOUR(hora) AS hora  FROM cita WHERE fecha > CURDATE() OR (fecha = CURDATE() AND HOUR(hora) > HOUR(CURTIME()))";
$result = mysqli_query($conexion, $query);
$contenido = array();
$i = 0;

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $visita = array(
            "dia" => $row['fecha'],
            "hora" => $row['hora'],
            "trabajador" => $row['idTrabajador']
        );
        $i++;
        $contenido[$i] = $visita;
    }

}
$contenidoAñadir = json_encode($contenido);
$file = '../assets/JSON/visitas.json';
file_put_contents($file, $contenidoAñadir);


$contenidoJSON = file_get_contents($file);

echo $contenidoJSON;


?>
