<?
require_once("inc/bd.php");
require_once("inc/funciones/usuarios.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Recojo datos usuario
    $usuario = $_POST["usuario"];
    $clave = $_POST["clave"];

    //Compruebo usuario con func.
    $check = comprobar_usuario($usuario, $clave, $db);
    if (!$check) {
        //Si el usuario es incorrecto, lo anoto.
        $error = true;
    } else {
        //Si es correcto, inicio la ses. e incorporo los datos a la ses.
        session_start();
        $_SESSION["usuario"] = $usuario;
        $_SESSION["nombre"] = $check["nombre"];
        $_SESSION["codRes"] = $check["codRes"];
        //Redirijo
        header("Location: categorias.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso a la aplicación</title>
    <link rel="stylesheet" href="inc/estilo.css">
    <link rel="stylesheet" href="inc/estiloLogin.css">

</head>

<body>
    <?
    //Si hace logout, se lanza un mensaje.
    if (isset($_GET["logout"]) && $_GET["logout"] == "true") {
    ?>
        <div class="conseguido">Se ha cerrado la sesión correctamente.</div>
    <?
    }
    //Lanzo mensaje si no está log.
    if (isset($_GET["redirigido"]) == true && $_GET["redirigido"] == "true") {
        echo "<div class='error'>Necesita estar logueado para acceder a esa página.</div>";
    }
    //Si las credenciales son incorrectas...
    if (isset($error) && $error = true) {
        echo "<div class='error'>Revise el usuario y contraseña.</div>";
    }

    ?>
    <form action="login.php" method="POST">

        <fieldset>
            <legend>Acceso para Restaurantes</legend>
            <table id="login">
                <tr>
                    <td><label for="usuario">Usuario</label></td>
                    <td>
                        <input type="text" name="usuario" id="usuario" value="<?= ($_SERVER["REQUEST_METHOD"] == "POST") ? $usuario : "" ?>" placeholder="rest@rest.es">
                    </td>
                </tr>
                <tr>
                    <td><label for="clave">Clave</label></td>
                    <td>
                        <input type="password" name="clave" id="clave" placeholder="Clave">
                    </td>
                </tr>
            </table>
            <button type="submit">Acceder</button>
        </fieldset>
    </form>
</body>

</html>