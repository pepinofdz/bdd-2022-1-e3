<?php
session_start();
require("../config/conection.php");
$userpass = strval($_SESSION['username']);

$codigo_vuelo = strval($_POST['codigo_vuelo']);
$pass1 = $_POST['pass1'];
$pass2 = $_POST['pass2'];
$pass3 = $_POST['pass3'];

$pasajeros_temp = [$pass1, $pass2, $pass3];
$pasajeros = [];
foreach ($pasajeros_temp as $p) {
    if ($p != '') {
        array_push($pasajeros, $p);
    }
}

echo $userpass;
echo "<br>";
echo $codigo_vuelo;
echo "<br>";

$cant_pasajeros = intval(count($pasajeros));
echo "Cantidad de pasajeros: $cant_pasajeros";
echo "<br>";

foreach ($pasajeros as $p) {
    echo $p;
    echo "<br>";
}
$pasajeros_string = implode(",", $pasajeros);
echo $pasajeros_string;
echo "<br>";


$query = "SELECT reservar('$userpass', '$pasajeros_string', '$codigo_vuelo');";
echo $query;
echo "<br>";
$result = $db1 -> prepare($query);
$result -> execute();
$data = $result -> fetchAll();

foreach ($data as $d) {
    echo "Valor: $d[0]";
    echo "<br>";
    echo $d[1];
}

$out = substr($data[0][0], 1, strlen($data[0][0]) - 2);
$out_list = explode(",", $out);

foreach($out_list as $o) {
    echo $o;
    echo "<br>";
}

if ($out_list[0] == '420') {
    $msg = 'Reserva realizada exitosamente';
    header("Refresh: 0; url = ../index.php?msg=$msg");
}
else {
    $msg = "Ha ocurrido un error. Verifica los datos e intentalo nuevamente";
    header("Refresh: 0; url = ../views/reservar.php?codigo_vuelo=$codigo_vuelo&msg=$msg");
}



?>