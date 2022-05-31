<?php

session_start();

if (isset($_SESSION['usuarios'])) {
    header('Location: views/menuPrincipal.php');
} else {
    header('Location: contenido.php');
}


?>