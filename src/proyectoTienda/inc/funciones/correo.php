<?

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'inc/correo/src/Exception.php';
require 'inc/correo/src/PHPMailer.php';
require 'inc/correo/src/SMTP.php';
require 'inc/funciones/productos.php';
require 'inc/bd.php';

const ARCHIVO_CONF = "inc/configuracionCorreo.xml";
const ESQUEMA = "inc/correo/configuracionCorreo.xsd";

function crearCorreo($carrito, $pedido, $correo, $nombre, $db)
{
    $pesoTotal = 0;
    $mensaje = "<h2>Pedido nº$pedido </h2> <h3>Restaurante: $nombre </h3>";
    $mensaje .= "<style>
    table, td, th {
        border: 2px solid black;
        border-collapse: collapse;
    }
    th{
        background-color: silver;
    }
    </style>";
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
    //Cargo los datos de los productos con sus respectivas claves.
    $productos = cargar_productos(array_keys($carrito), $db);
    //Creo una row en la tabla para cada uno de ellos.
    foreach ($productos as $producto) {
        $nombre = $producto["nombre"];
        $descripcion = $producto["descripcion"];
        $peso = $producto["peso"];
        $pesoTotal += $peso;
        $unidades = $_SESSION["carrito"][$producto["codProd"]];
        $mensaje .= "<tr>
                        <td>$nombre</td>
                        <td>$descripcion</td>
                        <td>$peso</td>
                        <td>$unidades</td>
                    </tr>";
    }
    $mensaje .= "</table>";
    $mensaje .= "<br><br>";
    //Modificado para que muestre el peso total del pedido, ejercicio extra.
    $mensaje .= "<i>Peso total: $peso</i>";
    return $mensaje;
}
function cargarConfiguracion($archivo, $esquema)
{
    //Creo documento externo
    $config = new DOMDocument;
    //Cargo con su respectivo nombre.
    $config->load($archivo);

    //Valido con el xsl
    if (!$config->schemaValidate($esquema)) {
        //Guardo errores, y de haberlos los muestro.
        $errores = libxml_get_errors();
        foreach ($errores as $error) {
            echo "Error en la sintaxis: " . $error->message;
        }
        throw new Exception("Hay errores en el archivo de configuración.");
    }
    //Almaceno en un array las conf. de correo.
    $configuraciones = [
        "servidor" => $config->getElementsByTagName("servidor")->item(0)->nodeValue,
        "puerto" => $config->getElementsByTagName("puerto")->item(0)->nodeValue,
        "usuario" => $config->getElementsByTagName("usuario")->item(0)->nodeValue,
        "password" => $config->getElementsByTagName("password")->item(0)->nodeValue,
        "encriptacion" => $config->getElementsByTagName("encriptacion")->item(0)->nodeValue
    ];
    //Las devuelvo.
    return $configuraciones;
}
//Función para envio de correo.
function envioCorreo($nombreOrigen, $correoDestino, $nombreDestino, $mensaje, $asunto)
{
    $configuraciones = cargarConfiguracion(ARCHIVO_CONF, ESQUEMA);
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->CharSet = "UTF-8";
    // $mail->SMTPDebug = 2;
    //  $mail->SMTPAuth = true;
    //  $mail->SMTPSecure = $configuraciones["encriptacion"];
    $mail->Host = $configuraciones["servidor"];
    $mail->Port = $configuraciones["puerto"];
    $mail->Username = $configuraciones["usuario"];
    $mail->Password = $configuraciones["password"];
    // $mail->Password = "amhwftxuqtjjmxyb";
    $mail->SetFrom($configuraciones["usuario"], $nombreOrigen);
    $mail->Subject = $asunto;
    $mail->MsgHTML($mensaje);
    //$mail -> addAttachment("empleado.xsd");
    $address = $correoDestino;
    $mail->AddAddress($address, $nombreDestino);
    if (!$mail->Send()) {
        throw new Exception("Error al enviar el correo, inténtelo de nuevo.");
    }
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
    foreach ($listaCorreos as $correo) {
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
