<?
require_once("inc/funciones/sesiones.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Recojo el código de producto del post.
    $cod = $_POST["codProd"];
    //Recojo las uds. deseadas.
    $unidades = (int)$_POST["unidades"];
    if (isset($_SESSION["carrito"][$cod])) {
        //Si existe, añado las unidades a las ya existentes.
        $_SESSION["carrito"][$cod] += $unidades;
    } else {
        //Si es nuevo, directamente lo igualo.
        $_SESSION["carrito"][$cod] = $unidades;
    }
}
//Redirijo, como se me pide en el ejercicio extra, a la página de la categoria del prod.
header("Location: productos.php?categoria=" . $_POST["codCat"]);
