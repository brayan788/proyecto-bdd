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
    $origen = $_POST["origen"];
    $destino = $_POST["destino"];
    $fecha = $_POST["fecha3"];
    $query = "SELECT re.reserva_id, re.codigo_reserva, re.numero_ticket, re.vuelo_id, re.pasaporte_comprador, re.nombre_comprador, re.nacionalidad_comprador, re.fecha_nacimiento_comprador, re.numero_asiento, re.clase, re.comida_y_maleta, re.pasaporte_pasajero, re.nombre_pasajero, re.nacionalidad_pasajero, re.fecha_nacimiento_pasajero
            FROM vuelos vu
            JOIN reservas re ON vu.vuelo_id=re.vuelo_id
            JOIN aerodromos ae ON ae.aerodromo_id=vu.aerodromo_salida_id
            WHERE vu.estado LIKE 'aceptado' AND fecha_salida>='$fecha' AND ae.nombre_ciudad='$origen';";
  $result = $db -> prepare($query);
  $result -> execute();
  $reservas = $result -> fetchAll();
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

<form action="../consultas/pasajeros.php" method="get">
    <input type="submit" value="Volver">
</form>
</body>
</html>