<? 
function comprobar_usuario($usuario,$clave,$db){
    $sql = "SELECT codRes,nombre,correo,clave FROM restaurantes WHERE correo = :usuario";
    $consultaPrep = $db->prepare($sql);
    
    $consultaPrep->execute(array(":usuario" => $usuario));
    if($consultaPrep->rowCount() == 1) {
        $datos = $consultaPrep->fetch();
        //Modificado para que compare la clave encriptada (ejercicio extra)
        if(password_verify($clave,$datos["clave"])) {
            return $datos;
        } else {
            return false;
        }
    } else {
        return false;
    }
}