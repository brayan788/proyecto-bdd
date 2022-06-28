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

	$pas = $_SESSION['username'];
	$num = "SELECT pasaporte_pasajero FROM reservas WHERE nombre_pasajero LIKE '$pas%';";
	$query = "SELECT * FROM reservas WHERE nombre_pasajero LIKE '$pas%';";
	$result = $db -> prepare($query);
	$result -> execute();
	$reservas = $result -> fetchAll();

	$result1 = $db -> prepare($num);
	$result1 -> execute();
	$numeros = $result1 -> fetchAll();
	echo "Pasajero: $pas, numero de pasaporte: $numeros[0]";

	$ciudadesa = "SELECT DISTINCT ae.nombre_ciudad FROM aerodromos ae INNER JOIN vuelos vu ON ae.aerodromo_id=vu.aerodromo_salida_id WHERE vu.estado LIKE 'aceptado' ORDER BY ae.nombre_ciudad ASC;";
	$result2 = $db -> prepare($ciudadesa);
	$result2 -> execute();
	$dataCollected = $result2 -> fetchAll();

	$ciudades = "SELECT DISTINCT ae.nombre_ciudad FROM aerodromos ae INNER JOIN vuelos vu ON ae.aerodromo_id=vu.aerodromo_llegada_id WHERE vu.estado LIKE 'aceptado' ORDER BY ae.nombre_ciudad ASC;";
	$result3 = $db -> prepare($ciudades);
	$result3 -> execute();
	$dataCollected1 = $result3 -> fetchAll();

	$fechas = "SELECT DISTINCT fecha_salida FROM vuelos WHERE estado LIKE 'aceptado' ORDER BY fecha_salida ASC;";
	$result4 = $db -> prepare($fechas);
	$result4 -> execute();
	$dataCollected2 = $result4 -> fetchAll();
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
	  <th>Fecha nacimiento comprador</th>
	  <th>Numero de asiento</th>
	  <th>Clase</th>
	  <th>Comida y maleta</th>
	  <th>Pasaporte pasajero</th>
	  <th>Nombre pasajero</th>
	  <th>Nacionalidad pasajero</th>
	  <th>Fecha nacimiento pasajero</th>
    </tr>
  <?php
	foreach ($reservas as $reserva) {
		echo "<tr> <td>$reserva[0]</td> <td>$reserva[1]</td> <td>$reserva[2]</td> <td>$reserva[3]</td> <td>$reserva[4]</td> <td>$reserva[5]</td> <td>$reserva[6]</td> <td>$reserva[7]</td> <td>$reserva[8]</td> <td>$reserva[9]</td> <td>$reserva[10]</td> <td>$reserva[11]</td> <td>$reserva[12]</td> <td>$reserva[13]</td> <td>$reserva[14]</td></tr>";
	}
  ?>
	</table>

	<form align="center" action="pasajeros2.php" method="post">
	Ciudad de origen:
	<select name="origen">
		<?php
		#Para cada tipo agregamos el tag <option value=value_of_param> visible_value </option>
		foreach ($dataCollected as $d) {
		echo "<option value=$d[0]>$d[0]</option>";
		}
		
?>
</select>

	Ciudad de destino:
	<select name="destino">
		<?php
		#Para cada tipo agregamos el tag <option value=value_of_param> visible_value </option>
		foreach ($dataCollected1 as $d1) {
		echo "<option value=$d1[0]>$d1[0]</option>";
		}
?>
</select>

	Fecha de despegue:
		<select name="fecha3">
		<?php
		#Para cada tipo agregamos el tag <option value=value_of_param> visible_value </option>
		foreach ($dataCollected2 as $d2) {
		echo "<option value=$d2[0]>$d2[0]</option>";
		}
?>
</select>
	<input type="submit" value="Buscar por tipo">
	</form>

<?php include('../templates/footer.html'); ?>
