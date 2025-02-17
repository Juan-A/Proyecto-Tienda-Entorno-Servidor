<?
require_once("inc/bd.php");
require_once("inc/funciones/sesiones.php");
require_once("inc/funciones/productos.php");
require_once("inc/secciones/cabecera.php");


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
</head>

<body>
    <?
    //Si el carrito está vacío...
    if (empty($_SESSION["carrito"])) {
        echo "<h2>Carrito vacío</h2>";
    } else {
        //Si no, cargo productos en una variable.
        $productos = cargar_productos(array_keys($_SESSION["carrito"]), $db);

    ?>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Peso</th>
                <th>Unidades</th>
                <th>Eliminar</th>
            </tr>
            <?
            //Imprimo los productos en el carrito.
            foreach ($productos as $producto) {
            ?>
                <tr>
                    <td><?= $producto["nombre"] ?></td>
                    <td><?= $producto["descripcion"] ?></td>
                    <td><?= $producto["peso"] ?></td>
                    <td><?= $_SESSION["carrito"][$producto["codProd"]] ?></td>
                    <td>
                        <form action="eliminar.php" method="POST">
                            <input type="hidden" value="<?= $producto["codProd"] ?>" name="codProd">
                            <input type="number" value="1" name="unidades" min="0">
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?
            }
            ?>

        </table>
        <div id="btnConfirmar"><a href="procesar_pedido.php">Procesar Pedido</a></div>






    <?




    }
    ?>
</body>

</html>