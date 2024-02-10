<?php

function ConectarBd() {
    $cadena_conexion = 'mysql:dbname=clubdeportivo;host=127.0.0.1';
    $usuario = 'root';
    $clave = '';
    try {
        //Se crea la conexión con la base de datos
        $bd = new PDO($cadena_conexion, $usuario, $clave);
        return $bd;
    } catch (Exception $e) {
        header('Location: ../pages/error404.php');
        exit();
    }
}

?>
