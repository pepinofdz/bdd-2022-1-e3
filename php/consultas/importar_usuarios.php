



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

    //Creando usuarios de companias
    $query = "SELECT * FROM compania;";
    $result = $db1 -> prepare($query);
    $result -> execute();
    
    $data = $result -> fetchAll();

    foreach ($data as $a) {
        $rand_pass = '';
        for ($i = 0; $i < 9; $i++) {
            $rand_pass .= strval(rand(0,9));
        }
        $user = strval($a[0]);
        $query = "INSERT INTO usuario(username, password, tipo) VALUES ( '$user' , '$rand_pass' , 2 );";
        $result = $db1 -> prepare($query);
        $result -> execute();
    }

    //header('Refresh: 0; url = ../index.php')
?>


