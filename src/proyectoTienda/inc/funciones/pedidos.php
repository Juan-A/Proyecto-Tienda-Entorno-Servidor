<?

function insertar_pedido($carrito, $codRes, $db)
{
    $fecha = date("d-m-Y H:i:s", time());
    $sql = "INSERT INTO pedidos (fecha,enviado,restaurante) VALUES ($fecha,0,$codRes)";
    $db->beginTransaction();
    $consultaPrep = $db->prepare($sql);
    if (!$consultaPrep->execute()) {
        return false;
    }
    $codPed = $db->lastInsertId();
    $sqlPedProd = "INSERT INTO pedidosproductos (pedido,producto,unidades) VALUES (:pedido,:producto,:unidades)";
    $sqlStock = "UPDATE productos SET stock = stock - :unidades WHERE codProd = :codProd ";
    $consultaPrep = $db->prepare($sqlPedProd);
    $consultaPrepStock = $db->prepare($sqlStock);

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
    return $codPed;
}
