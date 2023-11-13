<?
require_once("inc/funciones/sesiones.php");
$cod = $_POST["codProd"];
$unidades = (int)$_POST["unidades"];
if(isset($_SESSION["carrito"][$cod])){
    $_SESSION["carrito"][$cod] += $unidades;
} else {
    $_SESSION["carrito"][$cod] = $unidades;
}
header("Location: carrito.php");
