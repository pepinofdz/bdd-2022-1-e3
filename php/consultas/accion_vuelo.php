<?php
require("../config/conection.php");

echo $_POST['codigo_vuelo'];
echo '<br>';
echo $_POST['accion'];
echo '<br>';

$codigo_vuelo = $_POST['codigo_vuelo'];
//Aceptar
if ($_POST['accion'] == '1') {
    $accion = 'aceptado';
}
//Rechazar
else if ($_POST['accion'] == '0') {
    $accion = 'rechazado';
}

//Actualizada la base de datos grupo par
$query = "UPDATE fpls SET estado = '$accion' WHERE codigo = '$codigo_vuelo';";
$result = $db2 -> prepare($query);
$result -> execute();

$query = "SELECT MAX(id) FROM vuelo;";
$result = $db1 -> prepare($query);
$result -> execute();
$data = $result -> fetchAll();

$nuevo_id = $data[0][0] + 1;

//Obtener codigo de la compania
$query = "SELECT propuestas.codigo_compania FROM propuestas, fpls WHERE propuestas.propuesta_vuelo_id = fpls.propuesta_vuelo_id AND fpls.codigo = '$codigo_vuelo';";
$result = $db2 -> prepare($query);
$result -> execute();
$data = $result -> fetchAll();
$codigo_compania = $data[0][0];


$query = "SELECT aerodromo_salida_id, aerodromo_llegada_id, ruta_id, codigo, codigo_aeronave, fecha_salida, fecha_llegada, velocidad, altitud FROM fpls WHERE codigo = '$codigo_vuelo';";
$result = $db2 -> prepare($query);
$result -> execute();
$data = $result -> fetchAll();

$data0 = $data[0][0];
$data1 = $data[0][1];
$data2 = $data[0][2];
$data3 = $data[0][3];
$data4 = $data[0][4];
$data5 = $data[0][5];
$data6 = $data[0][6];
$data7 = $data[0][7];
$data8 = $data[0][8];

$query = "INSERT INTO vuelo VALUES ($nuevo_id, $data0, $data1, $data2, '$data3', '$data4', '$codigo_compania', '$data5', '$data6', $data7, $data8, '$accion')";
$result = $db1 -> prepare($query);
$result -> execute();

$msg = "INFO: El vuelo $codigo_vuelo ha sido actualizado y su estado ahora es $accion";

header("Refresh: 0; url = ../index.php?msg=$msg")

?>
