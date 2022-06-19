<?php session_start();
    if (isset($_SESSION['username'])){
        echo "Bienvenido/a: ";
        echo $_SESSION['username'];
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
    <?php
        if (!isset($_SESSION['username'])) {
    ?>
        <form align="center" action="views/login.php" method="get">
            <input type="submit" value="Iniciar sesión">
        </form>

        <form align="center" action="consultas/importar_usuarios1.php" method="post">
            <input type="submit" value="Importar Usuarios">
        </form>

    <?php } else { ?>
        <form align="center" action="views/logout.php" method="post">
            <input type="submit" value="Cerrar sesión">
        </form>

        <form align="center" action="consultas/pokemones.php" method="post">
            <input type="submit" value="Ver pokemones">
        </form>

        <form align="center" action="consultas/pelea_pokemon.php" method="post">
            <input type="submit" value="Ver peleas">
        </form>

        <form align="center" action="consultas/crear_pelea_pokemon.php" method="post">
            <input type="text" name="pid1">
            <input type="text" name="pid2">
            <input type="submit" value="Crear pelea">
        </form>

    <?php } ?>

</body>

</html>
