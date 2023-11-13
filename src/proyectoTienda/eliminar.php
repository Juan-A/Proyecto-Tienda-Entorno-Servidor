<?
require_once("inc/funciones/sesiones.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cod = $_POST["codProd"];
    $unidades = (int)$_POST["unidades"];
    if($_SESSION["carrito"][$cod] > $unidades){
        $_SESSION["carrito"][$cod] -= $unidades;
    }else{
        unset($_SESSION["carrito"][$cod]);
    }
}
header("Location: carrito.php");
?>