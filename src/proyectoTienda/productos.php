<?
//Cargo todas las funciones
require_once("inc/bd.php");
require_once("inc/funciones/sesiones.php");
require_once("inc/funciones/categorias.php");
require_once("inc/funciones/productos.php");
//La cabecera última, requiere la sesión.
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
    //Si la func. devuelve false
    if (!$cargaCategoria) {
        echo "<h2>No existe la categoria</h2>";
    } else {
        //Si OK, devuelve la categoria y sus columnas.
        echo "<h2>Productos de la categoria " . $cargaCategoria["nombre"] . "</h2>";
        //Almaceno los productos en un array.
        $productos = cargar_productos_categoria($_GET["categoria"], $db);
        if (!$productos) {
            echo "<h3>No hay productos en esta categoria</h3>";
        } else {
            //Si hay productos, imprime tabla.
    ?>
            <table>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Peso</th>
                    <th>Stock</th>
                    <th>Cantidad a comprar</th>
                </tr>
                <?
                foreach ($productos as $producto) {
                    //Modificado para que no muestre los productos sin stock, ejercicio extra.
                    if ($producto["stock"] == 0) {
                    } else {

                ?>
                        <tr>
                            <td><?= $producto["nombre"] ?></td>
                            <td><?= $producto["descripcion"] ?></td>
                            <td><?= $producto["peso"] ?></td>
                            <td><?= $producto["stock"] ?></td>
                            <td>
                                <form action="anadir.php" method="POST">
                                    <!-- Paso en oculto codProducto y codCategoria para posterior control. -->
                                    <input type="hidden" value="<?= $producto["codProd"] ?>" name="codProd">
                                    <input type="hidden" value="<?= $producto["categoria"] ?>" name="codCat">
                                    <input type="number" name="unidades" min=1 value=1>
                                    <button type="submit">Comprar</button>
                                </form>
                            </td>

                        </tr>
                <?
                    }
                }
                ?>
            </table>
    <?
        }
    }
    ?>

</body>

</html>