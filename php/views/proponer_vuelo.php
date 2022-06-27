<?php
    include("../templates/header.html");
    require("../config/conection.php");
    session_start();

    $query = "SELECT DISTINCT * FROM aerodromopistapuerto;";
    $result = $db2 -> prepare($query);
    $result -> execute();
    $aerodromo = $result -> fetchAll(); #Tabla Aerodromos. 0: ID, 1:Codigo IATA, 2: Codigo ICAO, 3: Nombre, 4: Ciudad, 5: Latitud, 6: Longitud

?>



<form align="center" action="../consultas/realizar_reserva.php" method="post">
    <p>Fecha de Salida</p>
    <input type="date" name="fecha_salida">
    
    <p>Hora de Salida</p>
    <input type="date" name="hora_salida">
    
    <p>Fecha estimada de Llegada</p>
    <input type="date" name="fecha_llegada">
    
    <p>Hora estimada de Llegada</p>
    <input type="date" name="hora_llegada">
    
    <p>Aerodromo de Salida</p>
    
    <p>Aerodromo de Llegada</p>
    
    <p>Aeronave</p>
    
    <p>ID de Ruta</p>
    
    <p>Cantidad Máxima de Pasajeros</p>
    
    <p>Pasaporte del Piloto</p>
    
    <p>Pasaporte del Copiloto</p>

</form>

