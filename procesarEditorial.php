<?php

require 'class/classBBDD.php'; 
require "class/classLibro.php"; 

$idEditorial = $_POST['editorial'];

if (empty($idEditorial)){
    $nomEditorial = "Error";

    require "views/vistaHead.php";
    require "views/vistaErrorEditorial.php";
    require "views/vistaFooter.php";
}

else{
    $db = new Database();

    //Consulta para obtener el nombre de la editorial
    $sql = "SELECT nomEditorial FROM Editorial WHERE idEditorial = " .$idEditorial;
    $resultadoEdit = $db->query($sql); $fila = $resultadoEdit->fetch_assoc(); $nomEditorial = $fila['nomEditorial'];

    // Consulta para obtener ISBN, Titulo libro, Curso y Total libros reservados de un ISBN, según la editorial seleccionada
    $sql = "SELECT l.ISBN, l.titulo, c.nombreCurso, IFNULL(COUNT(r.ISBN), 0) AS cantidadReservada
                FROM Libros l
                INNER JOIN LibrosCursos lc ON l.ISBN = lc.ISBN
                INNER JOIN Cursos c ON lc.idCurso = c.idCurso
                LEFT JOIN ReservasLibros r ON l.ISBN = r.ISBN
                WHERE l.idEditorial = ".$idEditorial." AND r.pedido = 'false'
                GROUP BY l.ISBN, c.nombreCurso ORDER BY l.ISBN";
    $result = $db->query($sql);

    // Crear un array para almacenar los objetos de Libro
    $libros = [];

    if ($result->num_rows > 0) {
        // Si la consulta devuelve algun resultado, se crean los objetos de libro
        while ($fila = $result->fetch_assoc()) {             
            if ($fila['cantidadReservada'] == 0){continue;} //Si no se ha reservado libros de un ISBN, omitimos incluirlo en la tabla
            else{
                //Push del registro en el array libros
                $libros[] = new Libro(
                    $fila['ISBN'], 
                    $fila['titulo'], 
                    $fila['nombreCurso'], 
                    $fila['cantidadReservada']
                );
            } 
        }
    }
    else {
        // Si no hay resultados, se muestra un mensaje
        $noLibros = "No se encontraron libros para esta editorial.";
    }

// Cerrar la conexión
$db->close();

require "views/vistaHead.php";
require "views/vistaTablaEditorial.php";
require "views/vistaFooter.php";

}