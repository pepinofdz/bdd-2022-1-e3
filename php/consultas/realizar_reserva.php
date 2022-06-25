<?php
session_start();

$userpass = $_SESSION['username'];

$codigo_vuelo = $_POST['codigo_vuelo'];
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

$cant_pasajeros = count($pasajeros);
echo "Cantidad de pasajeros: $cant_pasajeros";
echo "<br>";

foreach ($pasajeros as $p) {
    echo $p;
    echo "<br>";
}
$pasajeros_string = implode(", ", $pasajeros);
echo $pasajeros_string;
echo "<br>";





?>