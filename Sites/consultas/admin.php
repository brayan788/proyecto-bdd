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

 	$query = "SELECT * FROM fpl WHERE estado LIKE 'pendiente';";
	$result = $db -> prepare($query);
	$result -> execute();
	$vuelos = $result -> fetchAll();
  ?>

	<table>
    <tr>
      <th>ID</th>
      <th>Estado</th>
      <th>Codigo</th>
	  <th>Fecha_salida</th>
	  <th>Fecha_llegada</th>
	  <th>Velocidad</th>
	  <th>Altitud</th>
	  <th>Tipo_vuelo</th>
	  <th>Max_pasajero</th>
	  <th>Realizado</th>
	  <th>Aprobar</th>
	  <th>Rechazar</th>
    </tr>
  <?php
	foreach ($vuelos as $vuelo) {
  		echo "<tr> <td>$vuelo[0]</td> <td>$vuelo[1]</td> <td>$vuelo[2]</td> <td>$vuelo[3]</td> <td>$vuelo[4]</td> <td>$vuelo[5]</td> <td>$vuelo[6]</td> <td>$vuelo[7]</td> <td>$vuelo[8]</td> <td>$vuelo[9]</td> <a href="destino.php?variable1= $vuelo[0]">Aprobar</a> </tr>";
	}
  ?>
	</table>
  <br>
  <br>
  <br>

  <h3 align="center"> ¿Quieres ver los viajes entre dos fechas?: ?</h3>

  <form align="center" action="fechas.php" method="post">
    FECHA 1:
    <input type="date" name="fecha1">
    FECHA 2:
    <input type="date" name="fecha2">
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>
  <br>
  <br>
  <br>

<?php include('../templates/footer.html'); ?>
