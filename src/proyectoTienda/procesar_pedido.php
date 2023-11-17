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
    envioCorreo("Gestor Pedidos","juan13herrero@gmail.com",$_SESSION["usuario"],$_SESSION["nombre"],$mensaje,"Pedido");
    envioCorreo("Nuevo pedido","juan13herrero@gmail.com","juan13herrero@gmail.com","Gestor Pedidos",$mensaje,"Pedido");
    header("Location: categorias.php?exito=true");
}catch(Exception $e){
    echo $e->getMessage();
}
?>