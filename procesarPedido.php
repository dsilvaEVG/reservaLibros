<?php
// Aquí tenemos un $_POST en array que recoge en el índice el nombre del input (ISBN), y en su contenido la cantidad de libros que pedimos

require_once 'class/classBBDD.php'; 
require_once 'class/classLibro.php'; 

$idEditorial = $_POST['idEditorial'];
$nomEditorial = $_POST['nomEditorial'];
$fechaPedido = date('Y-m-d'); // Fecha actual

$datab = new Database();

// Crear un array para almacenar los libros y la cantidad ingresada
$libros = [];

// Recorrer los datos enviados en el formulario
foreach ($_POST as $isbn => $cantSolicitada) { // Array del $_POST, Indice=ISBN, Valor = cantSolicitada de libro
    if ($isbn !== 'idEditorial' && $isbn !== 'nomEditorial'){ // Descartamos los valores de hidden

        // Verificar si la cantidad solicitada es mayor que 0
        if ($cantSolicitada <= 0) {
            continue; // Si la cantidad es 0 o menor, saltamos este libro
        }

        // Consulta SQL de ISBN, título, curso y cantidad reservada por cada ISBN donde hemos introducido un valor
        $sql= "SELECT l.ISBN, l.titulo, c.nombreCurso, IFNULL(COUNT(r.ISBN), 0) AS cantidadReservada
            FROM Libros l
            INNER JOIN LibrosCursos lc ON l.ISBN = lc.ISBN
            INNER JOIN Cursos c ON lc.idCurso = c.idCurso
            LEFT JOIN ReservasLibros r ON l.ISBN = r.ISBN AND r.pedido = false 
            WHERE l.ISBN = '$isbn'
            GROUP BY l.ISBN, l.titulo, c.nombreCurso";

        // Ejecutar la consulta. Debería devolver solo una fila
        $result = $datab->query($sql);

        if ($result && $result->num_rows == 1) { // Si result es true (existe) y tiene solo una fila:
            $fila = $result->fetch_assoc(); //$fila es un array con los datos del result
            $cantidadReservada = $fila['cantidadReservada'];
            $cantidadSolicitada = $cantSolicitada; 

            // Comprobar que la cantidad solicitada no exceda la cantidad reservada
            if ($cantidadSolicitada > $cantidadReservada) {
                $cantidadSolicitada = $cantidadReservada; // Asignar la cantidad máxima reservada si se excede
            }

            // Crear el objeto Libro
            $libro = new Libro(
                $fila['ISBN'], 
                $fila['titulo'], 
                $fila['nombreCurso'], 
                $fila['cantidadReservada']);
        
            // Establecer la cantidad pedida del libro
            $libro->setCantidadPedida($cantidadSolicitada);
        
            // Añadir el libro al array solo si tiene una cantidad mayor que 0
            if ($cantidadSolicitada > 0) {
                $libros[] = $libro;
            }
        }
    }
}

// Verificar si se han agregado libros al array de libros
if (count($libros) === 0) {
    // Si no se ha pedido ningún libro, mostrar un mensaje de error y no continuar con la inserción en la base de datos
    echo "<p>No se ha solicitado ninguna cantidad de libros. El pedido no se ha procesado.</p><br/><a href='index.php'>Volver</a>";
    exit; // Detener la ejecución del script
}

// Insertar en la tabla Pedidos
$sqlPedido = "INSERT INTO Pedidos (idEditorial, fechaPedido) VALUES ('$idEditorial', '$fechaPedido')";
$datab->query($sqlPedido);

// Obtener el id del nuevo pedido insertado (idPedido)
$idPedido = $datab->query("SELECT LAST_INSERT_ID() AS idPedido")->fetch_assoc()['idPedido'];

// Insertar los libros en la tabla LibrosPedidos y actualizar los pedidos en ReservasLibros
foreach ($libros as $libro) {
    $isbn = $libro->getISBN();
    $cantidadPedida = $libro->getCantidadPedida();

    // Insertar el libro y la cantidad en la tabla LibrosPedidos
    $sqlLibrosPedidos = "INSERT INTO LibrosPedidos (idPedido, ISBN, cantidadLibros) 
                         VALUES ('$idPedido', '$isbn', '$cantidadPedida')";
    $datab->query($sqlLibrosPedidos);

    // Ahora actualizamos la cantidad de 'pedido' a true en ReservasLibros para los libros pedidos
    // Esto actualiza tantas filas como la cantidad de libros pedidos
    $sqlUpdatePedido = "UPDATE ReservasLibros 
                        SET pedido = true 
                        WHERE ISBN = '$isbn' AND pedido = false 
                        LIMIT $cantidadPedida";
    $datab->query($sqlUpdatePedido);
}

$datab->close();

require "views/exportarPdf.php"
?>