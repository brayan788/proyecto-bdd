<?php include('../templates/header.html');   ?>

<body>

    <?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
    require("../config/conexion.php");
    $inicio = $_POST["fecha1"];
    $final = $_POST["fecha2"];
    $query = "SELECT aeronave, COUNT(aeronave) FROM vuelo, tiene_vuelo WHERE vuelo.id =tiene_vuelo.idvuelo AND
    vuelo.realizado='realizado' AND vuelo.fecha_salida>='$inicio' GROUP BY aeronave;";
    $result = $db -> prepare($query);
    $result -> execute();
    $vuelos = $result -> fetchAll();
    ?>

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

<?php include('../templates/footer.html'); ?>
