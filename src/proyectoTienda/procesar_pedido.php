<?
require_once("inc/funciones/sesiones.php");
require_once("inc/funciones/pedidos.php");
require_once("inc/bd.php");
echo insertar_pedido($_SESSION["carrito"],$_SESSION["codRes"],$db);
?>