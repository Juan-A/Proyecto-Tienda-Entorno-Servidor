<?
$host = "db";
$usuario = "root";
$password = "nerja123";
$base_de_datos = "proyecto1";


$cadena_conn = "mysql:dbname=$base_de_datos;host=$host";
try {
    //Creo conexion
    $db = new PDO($cadena_conn, $usuario, $password);
} catch (PDOException $e) {
    //Si salta al catch, es que ha habido algún error.
    echo "<div class='conexFail'>Error en la conexión con la base de datos. :( </div><br> ";
    echo "Error: " . $e->getMessage();
}
