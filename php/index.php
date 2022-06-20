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

        <form align="center" action="consultas/importar_usuarios.php" method="post">
            <input type="submit" value="Importar Usuarios">
        </form>

    <?php } else { ?>
        <form align="center" action="views/logout.php" method="post">
            <input type="submit" value="Cerrar sesión">
        </form>

        <?php if ($_SESSION['tipo'] == 1) {?>
            <p>Eres admin DGAC</p>
        <?php } elseif ($_SESSION['tipo'] == 2) {?>
            <p>Eres compañia</p>
        <?php } elseif ($_SESSION['tipo'] == 3) {?>
            <p>Eres pasajero</p>
        <?php } ?>
        

    <?php } ?>

</body>

</html>
