<?php session_start();
    if (isset($_SESSION['username'])){
        echo "Bienvenido/a: ";
        echo $_SESSION['username'];
    }

    if (isset($_GET['msg'])) {
        $msg = $_GET['msg'];
    } else {
        $msg = '';
    }

    if (isset($_GET['fecha_inicio'])) {
        $_fecha_inicio = $_GET['fecha_inicio'];
    }

    if (isset($_GET['fecha_fin'])) {
        $_fecha_fin = $_GET['fecha_fin'];
    }
?>

<?php
    include("templates/header.html");
?>

<head>
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
</head>

<body>
    <h1> Entrega 3</h1>
    <br>
    <p><?php echo $msg;?></p>
    <br>
    <?php
        if (!isset($_SESSION['username'])) {
    ?>
        <form align="center" action="views/login.php" method="get">
            <input type="submit" value="Iniciar sesión">
        </form>

        <form align="center" action="consultas/importar_usuarios.php" method="post">
            <input type="submit" value="Importar Usuarios">
        </form>

    <?php } else { ?>
        <form align="center" action="views/logout.php" method="post">
            <input type="submit" value="Cerrar sesión">
        </form>

        <?php if ($_SESSION['tipo'] == 1) {?>
            <form align="center" action="index.php" method="get">
                <input type="date" name="fecha_inicio" required>
                <input type="date" name="fecha_fin" required>
                <input type="submit" value="Filtrar">
            </form>
            <form align="center" action="index.php" method="get">
                <p>Filtrar por fecha de solicitud</p>
                <input type="submit" value="Quitar filtro">
            </form>

            <?php include("./consultas/ver_vuelos.php")?>


        <?php } elseif ($_SESSION['tipo'] == 2) {?>
            <form align="center" action="views/proponer_vuelo.php" method="get">
                <input type="submit" value="Crear propuesta de vuelo">
            </form>
            <?php include("consultas/vuelos_compania.php")?>
        <?php } elseif ($_SESSION['tipo'] == 3) {?>
            <?php include("views/pasajero.php")?>
        <?php } ?>
        

    <?php } ?>

</body>

</html>
