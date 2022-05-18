<?php include('../templates/header.html');   ?>

<body>

    <?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
    require("../config/conexion.php");
    $inicio = $_POST["fecha1"];
    $final = $_POST["fecha2"];
    $query = "SELECT aeronave, COUNT(aeronave) FROM vuelo, tiene_vuelo WHERE vuelo.id =tiene_vuelo.idvuelo AND
    vuelo.realizado='realizado' AND vuelo.fecha_salida>='$inicio' AND vuelo.fecha_llegada<='$final' GROUP BY aeronave;";
    $result = $db -> prepare($query);
    $result -> execute();
    $vuelos = $result -> fetchAll();
    $query2 = "SELECT aeronave, COUNT(aeronave) FROM fpl, tiene_fpl, (SELECT fplid FROM asociado) AS t1  WHERE fpl.id =tiene_fpl.fplid AND
    fpl.realizado='realizado' AND fpl.fecha_salida>='$inicio' AND fpl.fecha_llegada<='$final' AND fpl.id IN (t1.flpid) GROUP BY aeronave;";
    $result2 = $db -> prepare($query2);
    $result2 -> execute();
    $vuelos2 = $result2 -> fetchAll();
    ?>
<h3 align="center"> VUELOS</h3>
<table>
<tr>
    <th>Codigo</th>
    <th>Cantidad de viajes</th>
</tr>
  <?php
	foreach ($vuelos as $vuelo) {
  		echo "<tr> <td>$vuelo[0]</td> <td>$vuelo[1]</td> </tr>";
	}
  ?>
	</table>
<h3 align="center"> FPL</h3>
<table>
<tr>
    <th>Codigo</th>
    <th>Cantidad de viajes</th>
</tr>
  <?php
	foreach ($vuelos2 as $vuelo2) {
  		echo "<tr> <td>$vuelo2[0]</td> <td>$vuelo2[1]</td> </tr>";
	}
  ?>
	</table>

<?php include('../templates/footer.html'); ?>
