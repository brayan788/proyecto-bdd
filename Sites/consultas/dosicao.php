<?php include('../templates/header.html');   ?>

<body>

  <?php
  require("../config/conexion.php"); #Llama a conexión, crea el objeto PDO y obtiene la variable $db

  $origen = $_POST["origen"];
  $destino = $_POST["destino"];
  $query = "SELECT * FROM vuelo, (SELECT id FROM aerodromo WHERE icao LIKE '$origen') AS t1, (SELECT id FROM aerodromo WHERE icao LIKE '$destino') AS t2, tiene_vuelo
  WHERE vuelo.id =tiene_vuelo.idvuelo AND tiene_vuelo.salida=t1.id AND tiene_vuelo.llegada=t2.id AND vuelo.estado='aceptado';";
  $result = $db -> prepare($query);
  $result -> execute();
  $dataCollected = $result -> fetchAll(); #Obtiene todos los resultados de la consulta en forma de un arreglo
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
	foreach ($dataCollected as $vuelo) {
  		echo "<tr> <td>$vuelo[0]</td> <td>$vuelo[1]</td> <td>$vuelo[2]</td> <td>$vuelo[3]</td> <td>$vuelo[4]</td> <td>$vuelo[5]</td> <td>$vuelo[6]</td> <td>$vuelo[7]</td> <td>$vuelo[8]</td> <td>$vuelo[9]</td> <td>$vuelo[10]</td> </tr>";
	}
  ?>
	</table>

<?php include('../templates/footer.html'); ?>
