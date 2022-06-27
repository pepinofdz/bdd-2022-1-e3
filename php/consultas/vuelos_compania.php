<?php
    require("config/conection.php");
    $username = $_SESSION['username'];
    $query = "SELECT codigo, fecha_salida, fecha_llegada, velocidad, altitud, codigo_aeronave FROM vuelo WHERE codigo_compania = '$username' AND estado = 'aceptado';";
    $result = $db1 -> prepare($query);
    $result -> execute();
    $data = $result -> fetchAll();
?>

<h1 class="title">Vuelos Aprobados</h1>

<?php
if (count($data) != 0) {
?>

<div id="table-wrapper" style="overflow-x:auto;">
<table class="table">
    <thead>
        <tr>
            <th>Codigo</th>
            <th>Fecha de Salida</th>
            <th>Fecha de Llegada</th>
            <th>Velocidad</th>
            <th>Altitud</th>
            <th>Codigo de la Aeronave</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($data as $a) {
                echo "<tr>
                <td>$a[0]</td>
                <td>$a[1]</td>
                <td>$a[2]</td>
                <td>$a[3]</td>
                <td>$a[4]</td>
                <td>$a[5]</td>
              </tr>";
            }
        ?>
    </tbody>
</table>
</div>

<?php
} else {?>
<p>No hay vuelos aprobados</p>
<?php }?>

<br>

<?php
    $username = $_SESSION['username'];
    $query = "SELECT codigo, fecha_salida, fecha_llegada, velocidad, altitud, codigo_aeronave FROM vuelo WHERE codigo_compania = '$username' AND estado = 'rechazado';";
    $result = $db1 -> prepare($query);
    $result -> execute();
    $data = $result -> fetchAll();
    ?>

<h1 class="title">Vuelos Rechazados</h1>

<?php
if (count($data) != 0) {
?>


<div id="table-wrapper" style="overflow-x:auto;">
<table class="table">
    <thead>
        <tr>
            <th>Codigo</th>
            <th>Fecha de Salida</th>
            <th>Fecha de Llegada</th>
            <th>Velocidad</th>
            <th>Altitud</th>
            <th>Codigo de la Aeronave</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($data as $a) {
                echo "<tr>
                <td>$a[0]</td>
                <td>$a[1]</td>
                <td>$a[2]</td>
                <td>$a[3]</td>
                <td>$a[4]</td>
                <td>$a[5]</td>
              </tr>";
            }
        ?>
    </tbody>
</table>
</div>
<?php
} else {?>
<p>No hay vuelos rechazados</p>
<?php }?>