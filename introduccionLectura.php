<?php session_start();

if (isset($_SESSION['usuarios'])) {
    require 'views/introduccionLectura.View.php';
} else {
    header('Location: login.php');
}