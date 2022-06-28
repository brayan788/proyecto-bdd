<?php include('../templates/header.html');   ?>

<?php
	session_start();
	if ($_SESSION['type'] !== "pasajero") {
		die('Acceso Denegado');
	}?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion_91.php");

  $origen = $_POST["origen"];
  $destino = $_POST["destino"];
  $fecha = $_POST["fecha3"];
  ?>

<?php include('../templates/footer.html'); ?>