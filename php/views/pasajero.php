<?php
require("config/conection.php");
$pasaporte = $_SESSION['username'];
$query = "SELECT * FROM persona WHERE pasaporte = '$pasaporte';";
$result = $db1 -> prepare($query);
$result -> execute();
$datos_usuario = $result -> fetchAll(); #0: Pasaporte; 1: Nombre; 2: Fecha Nacimiento; 3: Nacionalidad
?>

<p>Bienvenid@ <?php echo $datos_usuario[0][1];?></p>
<p>Pasaporte: <?php echo $datos_usuario[0][0];?></p>

<form align="center" action="views/buscar.php" method="get">
    <input type="submit" value="Ir a Buscar vuelos">
</form>

<?php
$query = "SELECT reserva.codigo, ticket.pasajero_pasaporte, ticket.numero_asiento, ticket.clase, ticket.comida_y_maleta FROM reserva, ticket WHERE ticket.reserva_id = reserva.reserva_id AND reserva.reservador_id = '$pasaporte';";
$result = $db1 -> prepare($query);
$result -> execute();
$reservas = $result -> fetchAll(); #0: Pasaporte; 1: Nombre; 2: Fecha Nacimiento; 3: Nacionalidad
?>
<p class="title">Tus Reservas</p>
<div id="table-wrapper" style="overflow-x:auto;">
<table class="table">
    <thead>
        <tr>
            <th>Codigo de Reserva</th>
            <th>Pasaporte del Pasajero</th>
            <th>Numero de Asiento</th>
            <th>Clase</th>
            <th>Incluye Comida y Maleta</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($reservas as $a) {
                if ($a[4] == 'f') {
                    $m = 'No';
                }
                else {
                    $m = 'Sí';
                }
                echo "<tr>
                <td>$a[0]</td>
                <td>$a[1]</td>
                <td>$a[2]</td>
                <td>$a[3]</td>
                <td>$m</td>
              </tr>";
            }
        ?>
    </tbody>
</table>
</div>