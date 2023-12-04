<?
require_once("inc/funciones/correo.php");
function insertar_pedido($carrito, $codRes, $db)
{
    //Recojo la fecha actual.
    $fecha = date("Y-m-d", time());
    $sql = "INSERT INTO pedidos (fecha,enviado,restaurante) VALUES (:fecha,0,$codRes)";
    //Comienzo transacción
    $db->beginTransaction();
    $consultaPrep = $db->prepare($sql);
    //Fijo la fecha en el parámetro para la consulta preparada.
    $consultaPrep->bindParam(":fecha", $fecha, PDO::PARAM_STR);
    if (!$consultaPrep->execute()) {
        //Si la ejecución no es correcta, revierte cambios, y devuelve false.
        $db->rollback();
        return false;
    }
    //Con el pedido insertado, ya tengo un código de pedido al que asociar los pedidosproductos.
    $codPed = $db->lastInsertId();

    //Ahora vamos a insertar en pedidosproductos, que es la asociación el producto, cod. pedido y unidades de este.
    $sqlPedProd = "INSERT INTO pedidosproductos (pedido,producto,unidades) VALUES (:pedido,:producto,:unidades)";
    //A su vez, creo consulta para actualizar stock
    $sqlStock = "UPDATE productos SET stock = stock - :unidades WHERE codProd = :codProd ";
    //Preparo ambas consultas.
    $consultaPrep = $db->prepare($sqlPedProd);
    $consultaPrepStock = $db->prepare($sqlStock);
    //Inserto para cada producto en el carrito, y actualizo stock.
    foreach ($carrito as $codProd => $unidades) {
        if (!($consultaPrep->execute(array(":pedido" => $codPed, ":producto" => $codProd, ":unidades" => $unidades)))) {
            $db->rollback();
            return false;
        }
        if (!($consultaPrepStock->execute(array(":unidades" => $unidades, ":codProd" => $codProd)))) {
            $db->rollback();
            return false;
        }
    }
    //Envio correo.
    $mensaje = crearCorreo($_SESSION["carrito"], $codPed, $_SESSION["usuario"], $_SESSION["nombre"], $db);
    //El primero es para el usuario, el segundo para el admin
    envioCorreo("Gestor Pedidos", $_SESSION["usuario"], $_SESSION["nombre"], $mensaje, "Pedido");
    envioCorreo("Pedidos", "juan13herrero@gmail.com", "Gestor Pedidos", $mensaje, "Pedido");
    //Confirmo cambios a la DB y term. transacción
    $db->commit();
    return $codPed;
}
