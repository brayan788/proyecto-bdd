<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Se obtiene el valor del input del usuario
  $fecha = $_POST["fecha"];
  $dia = substr(fecha,0,2);
  $año = substr(fecha,6,4);
  $fecha1 = str_replace($dia, $año, $fecha);
  $fecha2 = str_replace($año, $dia, $fecha1);
  echo $fecha2
 	$query = "SELECT id, catergoria, pasaporte FROM documento_p WHERE inicio<'$fecha2';";

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	$result = $db -> prepare($query);
	$result -> execute();
	$pilotos = $result -> fetchAll();
  ?>

  <table>
    <tr>
      <th>ID</th>
      <th>Categoria</th>
      <th>Pasaporte</th>
    </tr>
  
      <?php
        foreach ($pilotos as $p) {
          echo "<tr><td>$p[0]</td><td>$p[1]</td><td>$p[2]</td></tr>";
      }
      ?>
      
  </table>

<?php include('../templates/footer.html'); ?>
