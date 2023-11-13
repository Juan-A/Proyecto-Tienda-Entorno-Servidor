<?
function cargar_productos_categoria($codCat,$db){
    $sql = "SELECT * FROM productos WHERE categoria = :codigo";
    $consultaPrep = $db->prepare($sql);
    $consultaPrep->execute(array(":codigo" => $codCat));
    if($consultaPrep->rowCount() > 0) {
        return $consultaPrep->fetchAll();
    } else {
        return false;
    }

}
function cargar_productos($codsProducto,$db){
    $codsProducto = implode(",",$codsProducto);
    $sql = "SELECT * FROM productos WHERE codProd IN ($codsProducto)";
    $consultaPrep = $db->prepare($sql);
    $consultaPrep->execute();
    if($consultaPrep->rowCount() > 0) {
        return $consultaPrep->fetchAll();
    } else {
        return false;
    }
}