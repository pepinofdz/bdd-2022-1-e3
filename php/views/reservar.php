<?php
    include("../templates/header.html");
    require("../config/conection.php");
    session_start();
    $codigo_vuelo = $_GET['codigo_vuelo'];

    if (isset($_GET['msg'])){
        $msg = $_GET['msg'];
        echo $msg;
    }

    $pasaporte = $_SESSION['username'];
    $query = "SELECT * FROM persona WHERE pasaporte = '$pasaporte';";
    $result = $db1 -> prepare($query);
    $result -> execute();
    $datos_usuario = $result -> fetchAll(); #0: Pasaporte; 1: Nombre; 2: Fecha Nacimiento; 3: Nacionalidad
    $nombre = $datos_usuario[0][1]
?>

<head>
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
</head>



<body>

<p>Reserva de <?php echo $nombre?> para el vuelo <?php echo $codigo_vuelo;?></p>
<br>

<form align="center" action="../consultas/realizar_reserva.php" method="post">
    <?php
    echo "<input type='hidden' name='codigo_vuelo' value='$codigo_vuelo'>";
    ?>  

    <p>Pasaporte Pasajero 1</p>
    <input type="text" name="pass1">

    <p>Pasaporte Pasajero 2</p>
    <input type="text" name="pass2">

    <p>Pasaporte Pasajero 3</p>
    <input type="text" name="pass3">
    
    <br><br>

    <input type="submit" value="Realizar reserva">
</form>





</body>