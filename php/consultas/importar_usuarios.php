



<?php
    require("../config/conection.php");
    // $query = "INSERT INTO
    $query = "SELECT *
                FROM poke1;"; // Crear la consulta
    $result = $db -> prepare($query);
    $result -> execute();

    $data = $result -> fetchAll();
    header('Refresh: 0; url = ../index.php')
?>




