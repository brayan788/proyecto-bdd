<?php include('../templates/header.html');   ?>

<body>

<?php 
	session_start();
	if ($_SESSION['type'] !== "admin") {
		die('Acceso Denegado');
	}?>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion_82.php");
  $id = $_GET["id"];
 	$query = "UPDATE fpl SET estado = 'aprobado' WHERE id='$id';";
	$result = $db -> prepare($query);
	$result -> execute();
  ?>
