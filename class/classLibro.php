<?php

class Libro {
    private $ISBN;
    private $titulo;
    private $curso;
    private $cantidadReservada;
    private $cantidadPedida;

    // Constructor para inicializar los valores del libro
    public function __construct($ISBN, $titulo, $curso, $cantidadReservada) { //$cantidadReservada = 0
        $this->ISBN = $ISBN;
        $this->titulo = $titulo;
        $this->curso = $curso;
        $this->cantidadReservada = $cantidadReservada;
    }

    public function setCantidadPedida($num){
        $this->cantidadPedida = $num;
    }

    // Métodos getter para obtener los valores de los atributos
    public function getISBN() {
        return $this->ISBN;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getCurso() {
        return $this->curso;
    }

    public function getCantidadReservada() {
        return $this->cantidadReservada;
    }

    public function getCantidadPedida() {
        return $this->cantidadPedida;
    }

}

?>
