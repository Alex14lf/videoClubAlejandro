<?php

include '../lib/model/usuario.php';
include '../lib/model/pelicula.php';
include '../lib/model/actor.php';

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
            $userObject = new Usuario($fila["id"], $fila["username"], $fila["password"], $fila["rol"]);
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

function getMovies() {
    try {
        $bd = conectBd();
        $arraypeliculas = array();
        $consulta = $bd->prepare("SELECT * FROM peliculas;");
        $consulta->execute();

        // CONVERTIR EN ARRAY ASOCIATIVO
        $peliculas = $consulta->fetchAll(PDO::FETCH_ASSOC);

        foreach ($peliculas as $pelicula) {
            $pelicula = new Pelicula($pelicula["id"], $pelicula["titulo"], $pelicula["genero"], $pelicula["pais"], $pelicula["anyo"], $pelicula["cartel"]);
            array_push($arraypeliculas, $pelicula);
        }

        return $arraypeliculas;
    } catch (Exception $exc) {
        header('Location: ../../pages/error404.php');
        exit();
    }
}

function getActorsFromMovie($movie) {
    try {
        $bd = conectBd();
        $arrayactores = array();
        $idPelicula = $movie->getId();
        $consulta = $bd->prepare("SELECT * FROM actores where id IN (SELECT idActor FROM actuan WHERE idPelicula = :idPelicula);");
        $consulta->execute(array(":idPelicula" => $idPelicula));

        // CONVERTIR EN ARRAY ASOCIATIVO
        $actores = $consulta->fetchAll(PDO::FETCH_ASSOC);

        foreach ($actores as $actor) {
            $actor = new Actor($actor["id"], $actor["nombre"], $actor["apellidos"], $actor["fotografia"]);
            array_push($arrayactores, $actor);
        }

        return $arrayactores;
    } catch (Exception $exc) {
        header('Location: ../../pages/error404.php');
        exit();
    }
}

function deleteMovie($id) {
    try {
        $bd = conectBd();
        $consulta = $bd->prepare("DELETE FROM peliculas where id = :id");
        $consulta->execute(array(":id" => $id));
    } catch (Exception $exc) {
        header('Location: ../pages/error404.php');
        exit();
    }
}

function addMovie($cartel, $titulo, $genero, $anyo, $pais) {
    try {
        $bd = conectBd();
        $consulta = $bd->prepare("INSERT INTO peliculas (cartel, titulo, genero, anyo, pais) VALUES (:cartel, :titulo, :genero, :anyo, :pais)");
        $consulta->execute(array(":cartel" => $cartel,":titulo" => $titulo,":genero" => $genero,":anyo" => $anyo,":pais" => $pais));
    } catch (Exception $exc) {
        header('Location: ../pages/error404.php');
        exit();
    }
}
function editMovie($id,$cartel, $titulo, $genero, $anyo, $pais) {
    try {
        $bd = conectBd();
        $consulta = $bd->prepare("UPDATE peliculas SET cartel = :cartel, titulo = :titulo, genero = :genero, anyo = :anyo, pais = :pais WHERE id = :id");
        $consulta->execute(array(":id" => $id,":cartel" => $cartel,":titulo" => $titulo,":genero" => $genero,":anyo" => $anyo,":pais" => $pais));
    } catch (Exception $exc) {
        header('Location: ../pages/error404.php');
        exit();
    }
}

?>
