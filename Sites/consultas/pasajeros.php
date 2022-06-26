<?php include('../templates/header.html');   ?>

<?php
	session_start();
	if ($_SESSION['type'] !== "pasajero") {
		die('Acceso Denegado');
	}?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion_82.php");

	$pas = $_SESSION['username'];
	$num = "SELECT pasaporte_pasajero FROM reservas WHERE nombre_pasajero LIKE '$pas%';";
	$query = "SELECT vuelo_id FROM reservas WHERE nombre_pasajero LIKE '$pas%';";
	$result = $db -> prepare($query);
	$result -> execute();
	$reservas = $result -> fetchAll();

	$result1 = $db -> prepare($num);
	$result1 -> execute();
	$numeros = $result1 -> fetchAll();
	echo "Pasajero: $pas, numero de pasaporte: $numeros[0]"

	$result2 = $db -> prepare("SELECT nombre_ciudad FROM aerodromos, reservas WHERE aerodromos = vuelos.aerodromo_salida_id AND vuelos.estado='aceptado';");
	$result2 -> execute();
	$dataCollected = $result2 -> fetchAll();
  ?>

	<table>
    <tr>
	<th>Reserva id</th>
      <th>Codigo reserva</th>
      <th>Número ticket</th>
	  <th>Vuelo id</th>
	  <th>Pasaporte comprador</th>
	  <th>Nombre comprador</th>
	  <th>Nacionalidad comprador</th>
	  <th>Numero de asiento</th>
	  <th>Clase</th>
	  <th>Comida y maleta</th>
    </tr>
  <?php
	foreach ($reservas as $reserva) {
		echo "<tr> <td>$reserva[0]</td> <td>$reserva[1]</td> <td>$reserva[2]</td> <td>$reserva[3]</td> <td>$reserva[4]</td> <td>$reserva[5]</td> <td>$reserva[6]</td> <td>$reserva[7]</td> <td>$reserva[8]</td> <td>$reserva[9]</td> </tr>";
	}
  ?>
	</table>

<?php include('../templates/footer.html'); ?>
