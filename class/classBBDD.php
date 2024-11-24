<?php

class Database {
    private $host = '127.0.0.1';
    private $usuario = 'root';
    private $contrasenia = '';
    private $bbdd = 'proyectoreservas';
    private $conexion;

    // Constructor para establecer la conexión a la base de datos
    public function __construct() {
        $this->conexion = new mysqli($this->host, $this->usuario, $this->contrasenia, $this->bbdd);
    }

    // Método para ejecutar una consulta SELECT y obtener resultados
    public function query($sql) {
        return $this->conexion->query($sql);
    }

    // Cerrar la conexión
    public function close() {
        $this->conexion->close();
    }
}
?>
