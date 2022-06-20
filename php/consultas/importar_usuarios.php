



<?php
    require("../config/conection.php");
    // Crear usuario DGAC
    $query = "SELECT COUNT(*) FROM usuario WHERE tipo = 1;";
    $result = $db1 -> prepare($query);
    $result -> execute();
    
    $data = $result -> fetchAll();

    if ($data[0][0] == 0) {
        $query = "INSERT INTO usuario(username, password, tipo) VALUES ('DGAC', 'admin', 1);";
        $result = $db1 -> prepare($query);
        $result -> execute();
        
        $data = $result -> fetchAll();
    }

    header('Refresh: 0; url = ../index.php')
?>


