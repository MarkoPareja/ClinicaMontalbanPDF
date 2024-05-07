<?php

class Database {
    private $connection;

    public function __construct() {
        $dsn = 'mysql:host=mysql-adminmontalban.alwaysdata.net;dbname=adminmontalban_clinica;charset=utf8';
        $username = '329292_admin';
        $password = 'adminmontalban!';

        try {
            $this->connection = new PDO($dsn, $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            phpinfo();
            echo 'Error de conexión: ' . $e->getMessage();
            exit;
        }
    }

    
    public function listarConsultaId($idCita) {
        $statement = $this->connection->prepare("SELECT * FROM consulta WHERE id_cita = ".$idCita);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function infoDetalleConsulta($idCita) {
        $statement = $this->connection->prepare("SELECT Medicamentos.nombre, dosis, DATEDIFF(fecha_fin, fecha_inicio) AS duracion, fecha_inicio, fecha_fin, obs, Medicamentos.dosis_estandar FROM detalle_consulta JOIN Medicamentos ON Medicamentos.id=detalle_consulta.id_medicamento WHERE id_consulta = ".$idCita);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function infoCliente($idCliente) {
        $statement = $this->connection->prepare("SELECT persona.nombre, persona.apellido, cliente.TSI, persona.DNI FROM persona JOIN cliente ON cliente.DNI=persona.DNI WHERE cliente.idCliente = ".$idCliente);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function datosVisita($dni) {
        $statement = $this->connection->prepare("SELECT persona.nombre, cita.fecha, cita.descripcion, cita.idCita, cita.hora
                                                FROM cita 
                                                JOIN personal ON cita.idTrabajador = personal.idTrabajador 
                                                JOIN persona ON personal.DNI = persona.DNI 
                                                JOIN cliente ON cita.idCliente = cliente.idCliente 
                                                WHERE cliente.DNI = ? AND cita.estado = 'Realizada' ORDER BY cita.fecha DESC , cita.hora DESC;");
        $statement->execute([$dni]);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function idCliente($dni) {
        $statement = $this->connection->prepare("SELECT idCliente FROM cliente WHERE DNI = ?");
        $statement->execute([$dni]);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listaMedicos(){
        $statement = $this->connection->prepare("SELECT p.idTrabajador, pe.nombre, pe.apellido, e.descripcio 
                                                FROM personal p
                                                JOIN especialidad e ON p.especialidad = e.idEspecialidad
                                                JOIN persona pe ON p.DNI = pe.DNI");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function listaVisitas(){
        $statement = $this->connection->prepare("SELECT ci.idCita, pe.nombre AS nombreCliente, per.nombre AS nombreTrabajador, ci.fecha, ci.hora, ci.descripcion  
                                                FROM cliente c 
                                                JOIN cita ci ON (c.idCliente = ci.idCliente) 
                                                JOIN personal t ON (ci.idTrabajador = t.idTrabajador) 
                                                JOIN persona pe ON (c.DNI = pe.DNI) 
                                                JOIN persona per ON (t.DNI = per.DNI) 
                                                WHERE c.DNI = '$_SESSION[usuario]' AND ci.fecha >= CURDATE()
                                                ORDER BY ci.fecha, ci.hora");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    // Puedes agregar más funciones para otros selects según sea necesario
}

?>
