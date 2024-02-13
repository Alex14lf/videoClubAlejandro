<?php

session_start();
include("../lib/functions/functions.php");

if (!isset($_SESSION["user"]) || !isset($_SESSION["password"])) {
    header("Location:../index.php");
    exit();
} else {
    if (isset($_POST["cartel"]) && isset($_POST["titulo"]) && isset($_POST["genero"]) && isset($_POST["anyo"]) && isset($_POST["pais"])) {
        $id = $_POST["id"];
        $cartel = $_POST["cartel"];
        $titulo = $_POST["titulo"];
        $genero = $_POST["genero"];
        $anyo = $_POST["anyo"];
        $pais = $_POST["pais"];

        if (!empty($cartel) && !empty($titulo) && !empty($genero) && !empty($anyo) && !empty($pais)) {
            editMovie($id, $cartel, $titulo, $genero, $anyo, $pais);
            header("Location: admin.php");
            exit();
        } else {
            header("Location: admin.php?error=incompleto");
            exit();
        }
    } else {
        header("Location: admin.php?error=incompleto");
        exit();
    }
}
?>

