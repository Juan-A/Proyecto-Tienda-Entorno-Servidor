<?
//Carga los productos de determinada categoria.
function cargar_productos_categoria($codCat, $db)
{
    $sql = "SELECT * FROM productos WHERE categoria = :codigo";
    $consultaPrep = $db->prepare($sql);
    $consultaPrep->execute(array(":codigo" => $codCat));
    if ($consultaPrep->rowCount() > 0) {
        //Recojo todos los productos, de existir.
        return $consultaPrep->fetchAll();
    } else {
        return false;
    }
}
//Carga los productos en base a un array de cods. de producto.
function cargar_productos($codsProducto, $db)
{
    //Hago que php separe las claves de los productos por comas.
    $codsProducto = implode(",", $codsProducto);
    $sql = "SELECT * FROM productos WHERE codProd IN ($codsProducto)";
    $consultaPrep = $db->prepare($sql);
    $consultaPrep->execute();
    if ($consultaPrep->rowCount() > 0) {
        return $consultaPrep->fetchAll();
    } else {
        return false;
    }
}
