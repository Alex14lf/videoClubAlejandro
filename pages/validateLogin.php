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
    $lastAccess = date("d-m-Y H:i:s");
    setcookie("lastAccess", $lastAccess, 0, "/");
    $userObject = createUserObject($user);
    $rol = $userObject->getRol();
    $_SESSION["user"] = $user;
    $_SESSION["password"] = $password;
    $_SESSION["rol"] = $rol;
    if ($rol == 1) {
        echo"ADMIN";
        header("Location:admin.php");
    } else if ($rol == 0) {
        echo 'USER';
        header("Location:users.php");
    };
} else {
    header("Location:../index.php?login=incorrecto");
}
?>