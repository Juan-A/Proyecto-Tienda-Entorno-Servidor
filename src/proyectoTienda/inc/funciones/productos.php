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