<link rel="stylesheet" href="inc/estilo.css">
<header>
    <div id="datosHeader">
        <div>Usuario: <?= $_SESSION['usuario'] ?></div>
        <div>Nombre del restaurante: <?= $_SESSION["nombre"] ?></div>
    </div>
    <nav>

        <a href="categorias.php">Home</a>
        <!-- La siguiente línea imprime la cantidad (variedad) de artículos en el carrito -->
        <a href="carrito.php">Carrito<span> <?=(isset($_SESSION["carrito"]) && count($_SESSION["carrito"]) != 0) ? "(".count($_SESSION["carrito"]).")" : "" ?></span></a>
        <a href="cerrarSesion.php">Cerrar sesión</a>
    </nav>
</header>