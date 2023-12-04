<?
//Script para generar los hashes bcrypt con la passwd. de los usuarios.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $options = [
        'cost' => 11
    ];
    $clave = $_POST["clave"];
    $hash = password_hash($clave, PASSWORD_BCRYPT, $options);
    echo $hash;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador bcrypt</title>
</head>

<body>
    <form action="<?= $_SERVER["PHP_SELF"] ?>" method="POST">
        <input type="text" name="clave" id="clave" placeholder="Clave">
        <button type="submit">Generar</button>
    </form>
</body>

</html>