<?
require_once("inc/funciones/sesiones.php");
require_once("inc/funciones/pedidos.php");
require_once("inc/bd.php");
if(!insertar_pedido($_SESSION["carrito"],$_SESSION["codRes"],$db)){
    echo "Se ha producido un error al insertar el pedido.";
}
?>