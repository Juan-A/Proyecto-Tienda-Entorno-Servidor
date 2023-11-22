<link rel="stylesheet" href="inc/estilo.css">
<header>
    <div id="datosHeader">
        <div>Usuario: <?= $_SESSION['usuario'] ?></div>
        <div>Nombre del restaurante: <?= $_SESSION["nombre"] ?></div>
    </div>
    <nav>

        <a href="categorias.php">Home</a>
        <a href="carrito.php">Carrito</a>
        <a href="cerrarSesion.php">Cerrar sesión</a>
    </nav>
</header>