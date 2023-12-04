<?
function cargar_categorias($db)
{
    $sql = "SELECT * FROM categorias";
    $consultaPrep = $db->prepare($sql);
    //Ejecuto consulta
    $consultaPrep->execute();
    //Si hay resultado extraigo todos los datos.
    if ($consultaPrep->rowCount() > 0) {
        return $consultaPrep->fetchAll();
    } else {
        return false;
    }
}
function cargar_categoria($codCat, $db)
{
    $sql = "SELECT * FROM categorias WHERE codCat = :codigo";
    $consultaPrep = $db->prepare($sql);
    //Ejecuto consulta con el cod. de categoria pasado por parametro.
    $consultaPrep->execute(array(":codigo" => $codCat));
    if ($consultaPrep->rowCount() > 0) {
        //Extraigo, al ser una, la primera fila.
        return $consultaPrep->fetch();
    } else {
        return false;
    }
}
