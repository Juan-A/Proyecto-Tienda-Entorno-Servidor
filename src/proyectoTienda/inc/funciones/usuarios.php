<?
function comprobar_usuario($usuario, $clave, $db)
{

    $sql = "SELECT codRes,nombre,correo,clave FROM restaurantes WHERE correo = :usuario";
    //Preparo consulta
    $consultaPrep = $db->prepare($sql);
    //Ejecuto consulta
    $consultaPrep->execute(array(":usuario" => $usuario));
    //Si hay resultado para el usuario...
    if ($consultaPrep->rowCount() == 1) {
        //Recojo el primer resultado
        $datos = $consultaPrep->fetch();
        //Modificado para que compare la clave encriptada (ejercicio extra)
        //Y verifico password.
        if (password_verify($clave, $datos["clave"])) {
            return $datos;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
