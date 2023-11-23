<?

require_once("inc/bd.php");
require_once("inc/funciones/sesiones.php");
require_once("inc/funciones/categorias.php");
require_once("inc/secciones/cabecera.php");



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias</title>
</head>

<body>
    <main>

        <h1>Categorias</h1>
        <?
        if (isset($_GET["exito"]) && $_GET["exito"] == "true") {
        ?>
            <div class="conseguido">El pedido ha sido creado con éxito</div>
        <?
        } else if (isset($_GET["exito"]) && $_GET["exito"] == "false") {

        ?>
            <div class="error"><?=$_SESSION["error"]?></div>
        <?
        unset($_SESSION["error"]);
        }
        $categorias = cargar_categorias($db);
        if (!$categorias) {
            echo "<h2>No hay categorias</h2>";
        } else {
        ?>
            <table>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                </tr>
                <?
                foreach ($categorias as $categoria) {
                ?>
                    <tr>
                        <td><a href="productos.php?categoria=<?= $categoria["codCat"] ?>"><?= $categoria["nombre"] ?></a></td>
                        <td><?= $categoria["descripcion"] ?></td>
                    </tr>
                <?
                }
                ?>
            </table>
        <?
        }
        ?>
    </main>
</body>

</html>