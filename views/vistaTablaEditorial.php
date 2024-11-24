<body>
    <header>
        <a href="https://fundacionloyola.com/vguadalupe/" target="_blank">
            <img src="png/logoEVG.png" alt="Logo de la escuela">
        </a>
        <nav>
            <a href="#">Gestión</a>
            <a href="#">Info Reservas</a>
            <a href="#">Validación Sol.</a>
            <a href="#">Estadísticas</a>
        </nav>
    </header>

    <main>
        <div>
            <a href="index.php">
        <img src="png/arrowBackSec.png" id="back" href="index.php"> </a>
    <h1><p><?php echo $nomEditorial; ?></p></h1> 
    <article>
    <?php
    if (isset($noLibros)) {
        echo "<p id='error'>$noLibros</p>";
    } 
    else { 
    ?>
    <form action="procesarPedido.php" method="POST">
        <input type="hidden" name="idEditorial" value="<?php echo $idEditorial; ?>"> 
        <input type="hidden" name="nomEditorial" value="<?php echo $nomEditorial; ?>">
        <table border="1">
            <tr>
                <th>ISBN</th>
                <th>Título</th>
                <th>Curso</th>
                <th>Cantidad Reservada</th>
                <th>Cantidad a Pedir</th>
            </tr>
            <?php foreach ($libros as $libro): ?>
                <tr>
                    <td><?php echo $libro->getISBN(); ?></td>
                    <td><?php echo $libro->getTitulo(); ?></td>
                    <td><?php echo $libro->getCurso(); ?></td>
                    <td><?php echo $libro->getCantidadReservada(); ?></td>
                    <td>
                        <input type="number" name="<?php echo $libro->getISBN(); ?>" value="0" min="0"> <!-- Input al final de cada fila. EL nombre que identifica la celda es el ISBN de dicho libro-->
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <input type="submit" value="Enviar Pedido" id="exportar">
    </form>
    <?php
    } //Cierra la condicion else de hacer la tabla
    ?>
   </article>
        </div>
    </main>