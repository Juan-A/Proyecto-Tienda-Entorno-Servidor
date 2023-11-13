<?
require_once("inc/bd.php");
require_once("inc/funciones/sesiones.php");
require_once("inc/funciones/categorias.php");
require_once("inc/funciones/productos.php");
require_once("inc/secciones/cabecera.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
</head>
<body>

    <?
    $cargaCategoria = cargar_categoria($_GET["categoria"], $db);
    if(!$cargaCategoria){
        echo "<h2>No existe la categoria</h2>";
    } else {
        echo "<h2>Productos de la categoria ".$cargaCategoria["nombre"]."</h2>";
        $productos = cargar_productos_categoria($_GET["categoria"], $db);
        if(!$productos){
            echo "<h3>No hay productos en esta categoria</h3>";
        } else {
            ?>
            <table>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Peso</th>
                    <th>Stock</th>
                </tr>
                <?
                foreach ($productos as $producto) {
                ?>
                    <tr>
                        <td><?= $producto["nombre"] ?></td>
                        <td><?= $producto["descripcion"] ?></td>
                        <td><?= $producto["peso"] ?></td>
                        <td><?= $producto["stock"] ?></td>
                        <td>
                            <form action="anadir.php" method="POST">
                            <input type="hidden" value="<?=$producto["codProd"]?>" name="codProd">
                        <input type="number" name = "unidades" min=1 value=1>
                        <button type="submit">Comprar</button>
                            </form>
                    </td>

                    </tr>
                <?
                }
                ?>
            </table>
            <?
        }
    }
    ?>

</body>
</html>