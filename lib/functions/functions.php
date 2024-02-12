<?php

include '../lib/model/usuario.php';
function conectBd() {
    $cadena_conexion = 'mysql:dbname=videoclubonline;host=127.0.0.1';
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

function checkUser($username, $password) {
    $hashpassword = hash("sha256", $password);
    try {
        $bd = conectBd();
        $consulta = $bd->prepare("SELECT * from usuarios WHERE username=:username AND password=:password");
        $consulta->execute(array(":username" => $username, ":password" => $hashpassword));
        foreach ($consulta as $fila) { //ENTRA SOLO SI EXISTE EL USUARIO Y CONTRASEÑA
            if ($fila["username"] == $username && $fila["password"] == $hashpassword) {
                return true;
            } else {
                return false;
            }
        }
    } catch (Exception $ex) {
        header('Location: ../pages/error404.php');
        exit();
    }
}

function createUserObject($username) {
    
    try {
        $bd = conectBd();
        $consulta = $bd->prepare("SELECT * from usuarios WHERE username=:username");
        $consulta->execute(array(":username" => $username));
        foreach ($consulta as $fila) { //ENTRA SOLO SI EXISTE EL USUARIO 
            $userObject=new Usuario($fila["id"], $fila["username"], $fila["password"], $fila["rol"]);
            return $userObject;
        }
    } catch (Exception $ex) {
        header('Location: ../pages/error404.php');
        exit();
    }
}
//FUNCION PARA COMPROBAR QUE LO QUE PASO ES UN OBJETO Y MUESTRA BIEN LOS ATRIBUTOS
function displayUserObject($userObject) {
    if (is_object($userObject)) {
        echo $userObject->getUsername();
    } 
}


?>
