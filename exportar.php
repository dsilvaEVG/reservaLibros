<?php
    // Recoge los valores de los campos del formulario
    $pedido1 = isset($_POST['pedido1']) ? $_POST['pedido1'] : '';
    $pedido2 = isset($_POST['pedido2']) ? $_POST['pedido2'] : '';
    $pedido3 = isset($_POST['pedido3']) ? $_POST['pedido3'] : '';
    $pedido4 = isset($_POST['pedido4']) ? $_POST['pedido4'] : '';
    $pedido5 = isset($_POST['pedido5']) ? $_POST['pedido5'] : '';
    
    // Crea un array con los datos de los libros y sus correspondientes cantidades a pedir
    $libros = [
        ['isbn' => '123-4-56-789012-3', 'titulo' => 'Ciencias Naturales', 'curso' => '1º Bachillerato', 'cantidad_pedir' => $pedido1],
        ['isbn' => '123-4-56-789012-3', 'titulo' => 'Matemáticas', 'curso' => '2º Bachillerato', 'cantidad_pedir' => $pedido2],
        ['isbn' => '123-4-56-789012-3', 'titulo' => 'FOL', 'curso' => 'GS DAW, GM ASIR...', 'cantidad_pedir' => $pedido3],
        ['isbn' => '123-4-56-789012-3', 'titulo' => 'Inglés', 'curso' => '1º Bachillerato', 'cantidad_pedir' => $pedido4],
        ['isbn' => '123-4-56-789012-3', 'titulo' => 'Historia', 'curso' => '1º Bachillerato', 'cantidad_pedir' => $pedido5],
    ];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exportar Pedido</title>
    <link rel="stylesheet" href="exportar.css">
</head>
<body>

      <main>
        <table>
            <tr>
                <th>ISBN</th>
                <th>TÍTULO LIBRO</th>
                <th>CURSO</th>
                <th>CANT. PEDIR</th>
            </tr>
            <?php
            // Recorre los datos de los libros y los muestra en la tabla
            foreach ($libros as $libro) {
                echo "<tr>";
                echo "<td>" . $libro['isbn'] . "</td>";
                echo "<td>" . $libro['titulo'] . "</td>";
                echo "<td>" . $libro['curso'] . "</td>";
                echo "<td>" . $libro['cantidad_pedir'] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </main>

</body>
</html>