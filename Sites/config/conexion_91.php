<?php
  try {
    #Pide las variables para conectarse a la base de datos.
    require('data_91.php'); 
    # Se crea la instancia de PDO
    # $db = new PDO("pgsql:dbname=$databaseName;host=localhost;port=5432;user=$user;password=$password");
    $sname= "localhost";
    $unmae= "$user";
    $password = "$password";
    $db_name = "$databaseName";
    $conn = mysqli_connect($sname, $unmae, $password, $db_name);
  } catch (Exception $e) {
    echo "No se pudo conectar a la base de datos: $e";
  }
?>
