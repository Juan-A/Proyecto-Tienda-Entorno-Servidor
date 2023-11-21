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
    <title>categorias</title>
</head>

<body>
    <h1>Categorias</h1>
    <?
    if ($_GET["exito"] == "true") {
    ?>
        <div class="conseguido">El pedido ha sido creado con éxito</div>
    <?
    } else if ($_GET["exito"] == "false") {

    ?>
        <div class="error">Ha ocurrido un error al procesar el pedido.</div>
    <?
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
</body>

</html>