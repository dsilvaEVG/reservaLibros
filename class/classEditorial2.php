<?php

class Editorial {
    private $nombre;

    // Método para obtener el nombre de la editorial dado un idEditorial
    public function __construct($idEditorial) {
        require 'classBBDD.php';
        $dbeditorial = new Database();

        // Consulta SQL para obtener el nombre de la editorial
        $consulta = "SELECT nomEditorial FROM Editorial WHERE idEditorial = ".$idEditorial;
        $resultado = $dbeditorial->query($consulta);
        
        // Si la consulta devuelve algún resultado, asignamos el nombre a la propiedad privada
        if ($resultado && $resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            $this->nombre = $fila['nomEditorial'];
        }
        
        $dbeditorial->close();  // Cerramos la conexión
    }

    // Método para obtener el nombre de la editorial
    public function getNombre() {
        return $this->nombre;
    }
}

?>
