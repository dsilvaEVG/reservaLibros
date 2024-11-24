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
        <div class="claseFormulario">
            <h1>Selecciona una editorial</h1>
            <article>
                <form action="procesarEditorial.php" method="POST">
                    <label for="selectForm">Elige una editorial:</label>
                    <select name="editorial" id="selectForm">
                        <option value=""> - Elige... - </option>
                        <?php
                        // Si la consulta devuelve resultados, los mostramos en el <select>
                        if ($result && $result->num_rows > 0) {
                            // Recorrer cada editorial y agregarla como opción
                            while ($fila = $result->fetch_assoc()) {
                                echo "<option value='" .$fila['idEditorial']. "'>" . $fila['nomEditorial'] . "</option>";
                            }
                        } 
                        // Si no encuentra registros
                        else {
                            echo "<option>No hay editoriales disponibles</option>";
                        }
                        ?>
                    </select>
                    <input type="submit" id="enviar" value="Enviar">
                </form>
            </article>
        </div>
    </main>