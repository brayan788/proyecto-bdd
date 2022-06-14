<?php include('templates/header.html');   ?>

<body>
  <h1 align="center">Biblioteca Vuelos </h1>
  <p style="text-align:center;">Aquí podrás encontrar información acerca de vuelos.</p>

  <br>

  <h3 align="center"> ¿Quieres buscar los vuelos pendientes en ser aprobados?</h3>

  <form align="center" action="consultas/pendientes.php" method="post">
    <br/>
    <input type="submit" value="Buscar">
  </form>
  <br>

  <h3 align="center"> ¿Quieres buscar vuelos entre dos aerodromos?, dame los dos codigos ICAO</h3>

  <?php
  #Primero obtenemos todos los tipos de pokemones
  require("config/conexion.php");
  $result = $db -> prepare("SELECT DISTINCT icao FROM aerodromo;");
  $result -> execute();
  $dataCollected = $result -> fetchAll();
  ?>

  <form align="center" action="consultas/dosicao.php" method="post">
    Seleccionar ICAO salida:
    <input type="text" name="origen">
    Seleccionar ICAO llegada:
    <input type="text" name="destino">
    <br><br>
    <input type="submit" value="Buscar vuelos">
  </form>

  <br>
  <br>
  <br>
  </form>
  
  <br>
  <br>
  <br>

  <h3 align="center"> ¿Quieres conocer los Pilotos disponible para tu viaje: ?</h3>

  <form align="center" action="consultas/pilotos.php" method="post">
    FECHA DE VIAJE:
    <input type="date" name="fecha">
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>
  <br>
  <br>
  <br>
  <br>

<h3 align="center"> ¿Quieres buscar los bloques de mayor trafico por aerodromo?</h3>

<form align="center" action="consultas/trafico.php" method="post">
  <br/>
  <input type="submit" value="Buscar">

</form>
<br>
  <br>
  <br>

  <h3 align="center"> ¿Quieres las naves la cantidad de viaje entre dos fechas?: ?</h3>

  <form align="center" action="consultas/naves.php" method="post">
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
  <br>
<br>

  <h3 align="center">¿Quieres ver los pares que nunca han viajado juntos?</h3>

  <form align="center" action="consultas/pares.php" method="post">
    </select>
    <br><br>
    <input type="submit" value="VER">
  </form>

  <br>
  <br>
  <br>
  <br>
</body>
</html>
