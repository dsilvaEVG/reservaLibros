<?php

class Editorial {
    private $nombre;

    // Método para obtener el nombre de la editorial dado un idEditorial
    public function __construct($nombre) {
        $this->nombre = $nombre;
    }

    // Método para obtener el nombre de la editorial
    public function getNombre() {
        return $this->nombre;
    }
}

?>
