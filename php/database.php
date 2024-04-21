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

    public function infoConsulta($idCita) {
        $statement = $this->connection->prepare("SELECT Medicamentos.nombre, dosis, DATEDIFF(fecha_fin, fecha_inicio) AS duracion, fecha_inicio, fecha_fin, obs FROM consulta JOIN Medicamentos ON Medicamentos.id=consulta.id_medicamento WHERE id_cita = ".$idCita);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function infoCliente($idCliente) {
        $statement = $this->connection->prepare("SELECT persona.nombre, persona.apellido, cliente.TSI FROM persona JOIN cliente ON cliente.DNI=persona.DNI WHERE cliente.idCliente = ".$idCliente);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /*public function datosVisita($dni) {
        $statement = $this->connection->prepare("SELECT persona.nombre, cita.fecha, cita.descripcion FROM cita JOIN personal ON cita.idTrabajador=personal.idTrabajador JOIN persona ON personal.DNI=persona.DNI JOIN cliente ON cita.idCliente=cliente.idCliente WHERE cliente.DNI= '".$dni."'");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }*/

    public function datosVisita($dni) {
        $statement = $this->connection->prepare("SELECT persona.nombre, cita.fecha, cita.descripcion, cita.idCita 
                                                FROM cita 
                                                JOIN personal ON cita.idTrabajador = personal.idTrabajador 
                                                JOIN persona ON personal.DNI = persona.DNI 
                                                JOIN cliente ON cita.idCliente = cliente.idCliente 
                                                WHERE cliente.DNI = ? AND cita.estado = 'Realizada'");
        $statement->execute([$dni]);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function idCliente($dni) {
        $statement = $this->connection->prepare("SELECT idCliente FROM cliente WHERE DNI = ?");
        $statement->execute([$dni]);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    


    // Puedes agregar más funciones para otros selects según sea necesario
}

?>
