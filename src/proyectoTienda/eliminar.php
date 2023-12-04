<?
require_once("inc/funciones/sesiones.php");
//Si accedo al archivo mediante POST (correctamente)...
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Def. cod. producto a eliminar
    $cod = $_POST["codProd"];
    //Def. unidades a eliminar del carrito.
    $unidades = (int)$_POST["unidades"];
    //Si hay más unidades en el carrito de las que quiero eliminar...
    if ($_SESSION["carrito"][$cod] > $unidades) {
        //Se restan
        $_SESSION["carrito"][$cod] -= $unidades;
    } else {
        //Se quita directamente del carrito.
        unset($_SESSION["carrito"][$cod]);
    }
}
header("Location: carrito.php");
