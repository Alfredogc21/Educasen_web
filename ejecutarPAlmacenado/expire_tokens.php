<?php
// Hacemos la conexion a la base de datos
try {
    $conexion = new PDO('mysql:host=localhost;dbname=alfred16_educasen', 'alfred16_alfredooo', 'C8ewew$S@sBO');
    $conexion->exec("SET CHARACTER SET utf8");
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die("Error en el servidor");
}

// Ejecutar el procedimiento almacenado
$query = "CALL UpdateTokenStatus()";
$conexion->query($query);

// Cerrar la conexión
$conexion = null;
