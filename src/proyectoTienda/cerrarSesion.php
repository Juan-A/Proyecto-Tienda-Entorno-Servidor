<?
//Inicio, destruyo y redirijo.
session_start();
session_destroy();
header("Location: login.php?logout=true");
