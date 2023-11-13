<?
require_once("inc/funciones/sesiones.php");
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    $cod = $_POST["codProd"];
    $unidades = (int)$_POST["unidades"];
    if (isset($_SESSION["carrito"][$cod])) {
        $_SESSION["carrito"][$cod] += $unidades;
    } else {
        $_SESSION["carrito"][$cod] = $unidades;
    }
}
header("Location: carrito.php");
