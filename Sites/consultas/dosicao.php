<?php include('../templates/header.html');   ?>

<body>

  <?php
  require("../config/conexion.php"); #Llama a conexión, crea el objeto PDO y obtiene la variable $db

  $origen = $_POST["origen"];
  $destino = $_POST["destino"];
  $query = "SELECT * FROM vuelo, (SELECT id FROM aerodromo WHERE icao='$origen') AS t1, (SELECT id FROM aerodromo WHERE icao='$destino') AS t2, tiene_vuelo
  WHERE vuelo.id =tiene_vuelo.idvuelo AND tiene_vuelo.salida=t1.id AND tiene_vuelo.llegada=t2.id;";
  $result = $db -> prepare($query);
  $result -> execute();
  $dataCollected = $result -> fetchAll(); #Obtiene todos los resultados de la consulta en forma de un arreglo
  ?>

  <table>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Altura</th>
      <th>Peso</th>
      <th>Exp Base</th>
      <th>Tipo</th>
    </tr>
  <?php
  foreach ($dataCollected as $p) {
    echo "<tr> <td>$p[0]</td> <td>$p[1]</td> <td>$p[2]</td> <td>$p[3]</td> <td>$p[4]</td> <td>$p[5]</td> </tr>";
  }
  ?>
  </table>

<?php include('../templates/footer.html'); ?>
