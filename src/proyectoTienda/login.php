<?
require_once("inc/bd.php");
require_once("inc/funciones/usuarios.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $clave = $_POST["clave"];
    $check = comprobar_usuario($usuario, $clave, $db);
    if (!$check) {
        $error = true;
    } else {
        session_start();
        $_SESSION["usuario"] = $usuario;
        $_SESSION["nombre"] = $check["nombre"];
        $_SESSION["codRes"] = $check["codRes"];

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
</head>

<body>
    <?
    if (isset($_GET["logout"]) && $_GET["logout"] == "true") {
    ?>
        <div class="conseguido">Se ha cerrado la sesión correctamente.</div>
    <?
    }
    ?>
    <form action="login.php" method="POST">
        <div class="errorLogin"><?= (isset($error) && $error = true) ? "Revise el usuario y contraseña." : "" ?></div>
        <div class="errorLogin"><?= (isset($_GET["redirigido"]) == true && $_GET["redirigido"] == "true") ? "Necesita estar logueado para acceder a esa página." : "" ?></div>
        <fieldset>
            <legend>Acceso para Restaurantes</legend>
            <label for="usuario">Usuario</label>
            <input type="text" name="usuario" id="usuario" value="<?= ($_SERVER["REQUEST_METHOD"] == "POST") ? $usuario : "" ?>" placeholder="rest@rest.es">
            <label for="clave">Clave</label>
            <input type="password" name="clave" id="clave" placeholder="Clave">
            <button type="submit">Acceder</button>
        </fieldset>
    </form>
</body>

</html>