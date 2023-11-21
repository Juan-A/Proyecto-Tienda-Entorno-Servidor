<?

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'inc/correo/src/Exception.php';
require 'inc/correo/src/PHPMailer.php';
require 'inc/correo/src/SMTP.php';
require 'inc/funciones/productos.php';
require 'inc/bd.php';

function crearCorreo($carrito, $pedido, $correo,$nombre,$db)
{   
    $mensaje = "<h2>Pedido nº$pedido </h2> <h3>Restaurante: $nombre </h3>";
    $mensaje .= "<h4><i>Usuario: $correo </i></h4>";
    $mensaje .= "<i>Detalle del pedido</i>:";
    $mensaje .= "<br><br>";
    $mensaje .= "<table>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Peso</th>
                        <th>Unidades</th>
                    </tr>";

    $productos = cargar_productos(array_keys($carrito), $db);
    foreach ($productos as $producto) {
        $nombre = $producto["nombre"];
        $descripcion = $producto["descripcion"];
        $peso = $producto["peso"];
        $unidades = $_SESSION["carrito"][$producto["codProd"]];
        $mensaje .= "<tr>
                        <td>$nombre</td>
                        <td>$descripcion<td>
                        <td>$peso</td>
                        <td>$unidades<td>
                    </tr>";
    }
    $mensaje .= "</table>";
    return $mensaje;
}


function envioCorreo($nombreOrigen, $correoOrigen, $correoDestino, $nombreDestino, $mensaje, $asunto)
{

    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->CharSet = "UTF-8";
   // $mail->SMTPDebug = 2;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "tls";
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->Username = $correoOrigen;
    $mail->Password = "amhwftxuqtjjmxyb";
    $mail->SetFrom($correoOrigen, $nombreOrigen);
    $mail->Subject = $asunto;
    $mail->MsgHTML($mensaje);
    //$mail -> addAttachment("empleado.xsd");
    $address = $correoDestino;
    $mail->AddAddress($address, $nombreDestino);
    $mail->Send();
}
function envioCorreoMultiple($nombreOrigen, $correoOrigen, $listaCorreos, $mensaje, $asunto)
{

    $mail = new PHPMailer();
    $mail->IsSMTP();
    //$mail->SMTPDebug = 2;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "tls";
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->Username = $correoOrigen;
    $mail->Password = "amhwftxuqtjjmxyb";
    $mail->SetFrom($correoOrigen, $nombreOrigen);
    $mail->Subject = $asunto;
    $mail->MsgHTML($mensaje);
    //$mail -> addAttachment("empleado.xsd");
    foreach($listaCorreos as $correo){
        $mail->AddCC($correo, 'Cliente');
    }
    $resul = $mail->Send();
    if (!$resul) {
        //Error vale 1 con error de envio.
        setcookie("error", 1, time() + 3600 * 24);
    } else {
        //Error vale 0 con envio correcto.
        setcookie("error", 0, time() + 3600 * 24);
    }
}
