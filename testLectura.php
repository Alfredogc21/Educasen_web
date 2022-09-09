<?php session_start();

if (isset($_SESSION['usuarios'])) {
    require 'views/testLectura.view.php';
} else {
    header('Location: login.php');
}


?>