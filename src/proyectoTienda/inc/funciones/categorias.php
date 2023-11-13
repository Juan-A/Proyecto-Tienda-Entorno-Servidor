<?
function cargar_categorias($db)
{
    $sql = "SELECT * FROM categorias";
    $consultaPrep = $db->prepare($sql);
    $consultaPrep->execute();
    if($consultaPrep->rowCount() > 0) {
        return $consultaPrep->fetchAll();
    } else {
        return false;
    }
}
function cargar_categoria($codCat,$db){
    $sql = "SELECT * FROM categorias WHERE codCat = :codigo";
    $consultaPrep = $db->prepare($sql);
    $consultaPrep->execute(array(":codigo" => $codCat));
    if($consultaPrep->rowCount() > 0) {
        return $consultaPrep->fetch();
    } else {
        return false;
    }

}