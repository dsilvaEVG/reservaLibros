<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procesar Pedido</title>
    <style>
        table, td, tr, th{
            border: solid 1px black;
            border-collapse: collapse;
        }
       th, td{
            padding: 3px;
            padding-inline: 5px;
        }
    </style>
</head>
<body>

<main>
    <?php echo "<p>Editorial: ".$nomEditorial."</p>" ?>
    <?php echo "<p>Num. Pedido: ".$idPedido."</p>" ?>
    <div>
        <table border="1">
            <tr>
                <th>ISBN</th>
                <th>Título</th>
                <th>Curso</th>
                <th>Cantidad Solicitada</th>
            </tr>
            <?php foreach ($libros as $libro): ?>
                <tr>
                    <td><?php echo $libro->getISBN(); ?></td>
                    <td><?php echo $libro->getTitulo(); ?></td>
                    <td><?php echo $libro->getCurso(); ?></td>
                    <td><?php echo $libro->getCantidadPedida(); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</main>

</body>
</html>