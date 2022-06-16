<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

 	$query = "SELECT * FROM vuelo WHERE estado LIKE 'pendiente';";
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
	  <th>Fecha_propuesta</th>
	  <th>Velocidad</th>
	  <th>Altitud</th>
	  <th>Tipo_vuelo</th>
	  <th>Max_pasajero</th>
	  <th>Realizado</th>
    </tr>
  <?php
	foreach ($vuelos as $vuelo) {
  		echo "<tr> <td>$vuelo[0]</td> <td>$vuelo[1]</td> <td>$vuelo[2]</td> <td>$vuelo[3]</td> <td>$vuelo[4]</td> <td>$vuelo[5]</td> <td>$vuelo[6]</td> <td>$vuelo[7]</td> <td>$vuelo[8]</td> <td>$vuelo[9]</td> <td>$vuelo[10]</td> </tr>";
	}
  ?>
	</table>

<?php include('../templates/footer.html'); ?>
