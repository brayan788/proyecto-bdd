<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

 	$query = "(SELECT * FROM (SELECT pasaporte from documento_p) AS p1, (SELECT pasaporte from documento_p) AS p2 WHERE p1<>p2 EXCEPT (SELECT piloto, copiloto FROM tiene_fpl WHERE piloto<>copiloto)) EXCEPT (SELECT piloto,copiloto FROM tiene_vuelo WHERE piloto<>copiloto);";
	$result = $db -> prepare($query);
	$result -> execute();
	$vuelos = $result -> fetchAll();
  ?>

	<table>
    <tr>
      <th>Pasaporte 1</th>
      <th>Pasaporte 2</th>
    </tr>
  <?php
	foreach ($vuelos as $vuelo) {
  		echo "<tr> <td>$vuelo[0]</td> <td>$vuelo[1]</td> </tr>";
	}
  ?>
	</table>

<?php include('../templates/footer.html'); ?>