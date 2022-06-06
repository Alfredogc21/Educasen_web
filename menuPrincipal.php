<?php session_start();

if (isset($_SESSION['usuarios'])) {
    require 'views/menuPrincipal.view.php';
} else {
    header('Location: login.php');
}


?>