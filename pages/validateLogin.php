<?php
session_start();
include '../lib/functions/functions.php';

if (isset($_POST["user"]) && !empty($_POST["user"])) {
    $user = $_POST["user"];
    $usuarioIntroducido = true;
}
if (isset($_POST["password"]) && !empty($_POST["user"])) {
    $password = $_POST["password"];
    $passwordIntroducida = true;
}

if (!$passwordIntroducida || !$usuarioIntroducido) {
    header("location:../index.php");
}

if (checkUser($user, $password)) {
    $_SESSION["user"] = $user;
    $_SESSION["password"] = $password;
    $userObject = createUserObject($user);
    $rol=$userObject->getRol();
    if ($rol == 1) {
        echo"ADMIN";
        //header("Location:");
    } else if ($rol == 0) {
        echo 'USER';
        //header("Location:");
    };
} else {
    header("Location:../index.php?login=incorrecto");
}
?>