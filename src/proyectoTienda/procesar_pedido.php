<?
//Cargo funciones y sesión (requerida para procesos).
require_once("inc/funciones/sesiones.php");
require_once("inc/funciones/pedidos.php");
require_once("inc/bd.php");

try {
    insertar_pedido($_SESSION["carrito"], $_SESSION["codRes"], $db);
    //Paso a enviar correos directamente desde insertar pedido.
    //Vacío el carrito en caso de que todo vaya correctamente.
    unset($_SESSION["carrito"]);
    header("Location: categorias.php?exito=true");
} catch (Exception $e) {
    //Devuelvo un error en la cookie, para tener un error más específico.
    $_SESSION["error"] = $e->getMessage();
    header("Location: categorias.php?exito=false");
}
