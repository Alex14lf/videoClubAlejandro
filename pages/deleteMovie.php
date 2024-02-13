<?php

session_start();
include("../lib/functions/functions.php");
if (!isset($_SESSION["user"]) && !isset($_SESSION["password"])) {
    header("Location:../index.php");
} else {
    $id = $_GET["id"];
    deleteMovie($id);
    if ($_SESSION["rol"] == 1) {
        header("Location:admin.php");
        exit();
    } elseif ($_SESSION["rol"] == 0) {
        header("Location:users.php");
        exit();
    }
}
?>
