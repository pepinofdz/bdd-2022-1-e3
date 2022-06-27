<?php
    include("../templates/header.html");
    session_start();
?>

<head>
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
</head>


<?php
#Obtener los nombres de las ciudades de origen
require("../config/conection.php");
$query = "SELECT DISTINCT(aerodromopistapuerto.nombre_ciudad) FROM aerodromopistapuerto, fpls WHERE aerodromopistapuerto.aerodromo_id = fpls.aerodromo_salida_id AND fpls.estado = 'aceptado';";
$result = $db2 -> prepare($query);
$result -> execute();
$ciudades_origen = $result -> fetchAll(); #0: Ciudad
?>

<?php
#Obtener los nombres de las ciudades de destino
require("../config/conection.php");
$query = "SELECT DISTINCT(aerodromopistapuerto.nombre_ciudad) FROM aerodromopistapuerto, fpls WHERE aerodromopistapuerto.aerodromo_id = fpls.aerodromo_llegada_id AND fpls.estado = 'aceptado';";
$result = $db2 -> prepare($query);
$result -> execute();
$ciudades_destino = $result -> fetchAll(); #0: Ciudad
?>


<body>
    <form align="center" action="buscar.php" method="get">
        <p>Ciudad de Origen</p>
        <select name='ciudad_origen'>
            <?php foreach($ciudades_origen as $ciudad) {
                echo "<option value='$ciudad[0]'>$ciudad[0]</option>";
            }?>
        </select>
        <p>Ciudad de Destino</p>
        <select name='ciudad_destino'>
            <?php foreach($ciudades_destino as $ciudad) {
                echo "<option value='$ciudad[0]'>$ciudad[0]</option>";
            }?>
        </select>
        <p>Fecha de despegue</p>
        <input type="date" name="fecha_despegue" required>
        <input type="submit" value="Ir a Buscar vuelos">
    </form>

<?php
if (isset($_GET['ciudad_origen']) && isset($_GET['ciudad_destino']) && isset($_GET['fecha_despegue'])) {
    $ciudad_origen = $_GET['ciudad_origen'];
    $ciudad_destino = $_GET['ciudad_destino'];
    $fecha_despegue_consulta = $_GET['fecha_despegue'];

    $query = "SELECT DISTINCT aerodromo_id FROM aerodromopistapuerto, fpls WHERE aerodromopistapuerto.aerodromo_id = fpls.aerodromo_salida_id AND fpls.estado = 'aceptado' AND fpls.fecha_salida = '$fecha_despegue_consulta' AND aerodromopistapuerto.nombre_ciudad = '$ciudad_origen';";
    $result = $db2 -> prepare($query);
    $result -> execute();
    $a = $result -> fetchAll(); #IDs aerodromos de origen

    $aerodromos_origen = [];
    foreach($a as $i) {
        array_push($aerodromos_origen, $i[0]);
    }
    $aerodromos_origen_string = implode(", ", $aerodromos_origen);
    
    
    $query = "SELECT DISTINCT aerodromo_id FROM aerodromopistapuerto, fpls WHERE aerodromopistapuerto.aerodromo_id = fpls.aerodromo_llegada_id AND fpls.estado = 'aceptado' AND fpls.fecha_salida = '$fecha_despegue_consulta' AND aerodromopistapuerto.nombre_ciudad = '$ciudad_destino';";
    $result = $db2 -> prepare($query);
    $result -> execute();
    $a = $result -> fetchAll(); #IDs aerodromos de origen

    $aerodromos_destino = [];
    foreach($a as $i) {
        array_push($aerodromos_destino, $i[0]);
    }
    $aerodromos_destino_string = implode(", ", $aerodromos_destino);

    $query = "SELECT * FROM vuelo WHERE aerodromo_salida_id IN ($aerodromos_origen_string) AND aerodromo_llegada_id IN ($aerodromos_destino_string) AND fecha_salida = '$fecha_despegue_consulta';";
    $result = $db1 -> prepare($query);
    $result -> execute();
    $busqueda = $result -> fetchAll(); #IDs aerodromos de origen

}
?>

<div id="table-wrapper" style="overflow-x:auto;">
<table class="table">
    <thead>
        <tr>
            <th>Codigo de Vuelo</th>
            <th>Fecha de Salida</th>
            <th>Fecha de Llegada</th>
            <th>Aerodromo de Salida</th>
            <th>Aerodromo de Llegada</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if (isset($busqueda)){
                if ($busqueda != []) {
                    foreach ($busqueda as $a) {
                        $query = "SELECT nombre FROM aerodromo WHERE id = $a[1];";
                        $result = $db1 -> prepare($query);
                        $result -> execute();
                        $nombre_salida = $result -> fetchAll();
                        $nombre_salida = $nombre_salida[0][0];

                        $query = "SELECT nombre FROM aerodromo WHERE id = $a[2];";
                        $result = $db1 -> prepare($query);
                        $result -> execute();
                        $nombre_llegada = $result -> fetchAll();
                        $nombre_llegada = $nombre_llegada[0][0];
                        
                        echo "<tr>
                        <td>$a[4]</td>
                        <td>$a[7]</td>
                        <td>$a[8]</td>
                        <td>$nombre_salida</td>
                        <td>$nombre_llegada</td>
                        <td>
                            <form align='center' action='reservar.php' method='get'>
                                <input type='hidden' name='codigo_vuelo' value='$a[4]'>  
                                <input type='submit' value='Reservar'>
                            </form>
                        </td>
                    </tr>";
                    }   
                } else{
                    echo "<tr><td>No hay vuelos disponibles :c</td></tr>";
                }
            }
            
        ?>
    </tbody>
</table>
</div>

</body>