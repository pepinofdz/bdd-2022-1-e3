<?php
    require("config/conection.php");
    $username = $_SESSION['username'];
    $query = "SELECT * FROM fpls, propuestas WHERE fpls.propuesta_vuelo_id =  propuestas.propuesta_vuelo_id AND fpls.estado = 'pendiente';";
    $result = $db2 -> prepare($query);
    $result -> execute();
    $data = $result -> fetchAll();
?>

<?php
if (isset($_fecha_inicio)) {
    echo $_fecha_inicio;
    echo "<br>";
}
if (isset($_fecha_fin)) {
    echo $_fecha_fin;
    echo "<br>";
}
?>

<div id="table-wrapper" style="overflow-x:auto;">
<table class="table">
    <thead>
        <tr>
            <th>Codigo de Vuelo</th>
            <th>Fecha de Salida</th>
            <th>Hora de Salida</th>
            <th>Fecha de Llegada</th>
            <th>Hora de Llegada</th>
            <th>ID Aerodromo de Salida</th>
            <th>ID Aerodromo de Llegada</th>
            <th>Codigo de la Aeronave</th>
            <th>ID de la Ruta</th>
            <th>Velocidad</th>
            <th>Altitud</th>
            <th>Tipo de Vuelo</th>
            <th>Maximo de Pasajeros</th>
            <th>Pasaporte del Piloto</th>
            <th>Pasaporte del Copiloto</th>
            <th>Fecha de Envio de la Propuesta</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($data as $a) {
                echo "<tr>
                <td>$a[3]</td>
                <td>$a[4]</td>
                <td>$a[5]</td>
                <td>$a[6]</td>
                <td>$a[7]</td>
                <td>$a[8]</td>
                <td>$a[9]</td>
                <td>$a[10]</td>
                <td>$a[11]</td>
                <td>$a[12]</td>
                <td>$a[13]</td>
                <td>$a[14]</td>
                <td>$a[15]</td>
                <td>$a[17]</td>
                <td>$a[18]</td>
                <td>$a[21]</td>
                <td>
                    <form align='center' action='consultas/accion_vuelo.php' method='post'>
                        <input type='hidden' name='codigo_vuelo' value='$a[3]'>  
                        <select name='accion'>
                            <option value='1'>Aceptar</option>
                            <option value='0'>Rechazar</option>
                        </select>
                        <input type='submit' value='Realizar accion'>
                    </form>
                </td>
              </tr>";
            }
        ?>
    </tbody>
</table>
</div>