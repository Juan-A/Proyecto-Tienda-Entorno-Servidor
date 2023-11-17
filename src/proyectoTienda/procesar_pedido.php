<?
require_once("inc/funciones/sesiones.php");
require_once("inc/funciones/pedidos.php");
require_once("inc/bd.php");
require_once("inc/funciones/correo.php");
if(!$codPed=insertar_pedido($_SESSION["carrito"],$_SESSION["codRes"],$db)){
    echo "Se ha producido un error al insertar el pedido.";
}
$mensaje = crearCorreo($_SESSION["carrito"],$codPed,$_SESSION["usuario"],$_SESSION["nombre"],$db);
try{
    
}
?>