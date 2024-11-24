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
        <img src="png/arrowBackSec.png" id="back" href="index.php"> </a><!-- Boton para volver atras-->
    <h1><p><?php echo $nomEditorial; ?></p></h1> <!-- Error no hay Editorial seleccionada-->
    <article>
    <?php    
        echo "<p id='error'>Error: No se ha seleccionado editorial</p>";  
    ?>
    
   </article>
        </div>
    </main>