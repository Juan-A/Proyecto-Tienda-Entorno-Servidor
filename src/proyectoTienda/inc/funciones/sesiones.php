<?
//Inicia las sesiones en las páginas de la web.
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php?redirigido=true');
}
