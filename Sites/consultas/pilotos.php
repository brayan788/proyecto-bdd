<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Se obtiene el valor del input del usuario
  $fecha = $_POST["fecha"];
  $fecha = date_format($fecha, "y/m/d");

  #Se construye la consulta como un string
 	$query = "SELECT id, catergoria, pasaporte FROM documento_p WHERE inicio<$fecha and termino>$fecha;";

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
