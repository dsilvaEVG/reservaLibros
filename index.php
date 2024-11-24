<?php

//Conectar la base de datos y hacer búsquedas
require "class/classBBDD.php"; 

$db = new Database();

// Consulta para obtener las editoriales de la base de datos
$sql = "SELECT idEditorial, nomEditorial FROM Editorial";

// Ejecutar la consulta y guardarla en $result
$result = $db->query($sql);

// Cerrar la conexión
$db->close();

require "views/vistaHead.php";
require "views/vistaIndex.php";
require "views/vistaFooter.php";
?>