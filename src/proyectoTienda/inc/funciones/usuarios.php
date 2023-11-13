<? 
function comprobar_usuario($usuario,$clave,$db){
    $sql = "SELECT codRes,nombre,correo FROM restaurantes WHERE correo = :usuario AND clave = :clave";
    $consultaPrep = $db->prepare($sql);
    $consultaPrep->execute(array(":usuario" => $usuario, ":clave" => $clave));
    if($consultaPrep->rowCount() == 1) {
        return $consultaPrep->fetch();
    } else {
        return false;
    }
}