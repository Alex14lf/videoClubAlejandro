<?php
session_start();
include("functions.php");
if (!isset($_SESSION["user"]) && !isset($_SESSION["password"])) {
    header("Location:../index.php");
} else {
    if ($_SESSION["rol"] == 1){
        header("Location:admin.php");
    }
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Lista de Películas y Buzón de Sugerencias</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/admin.css" rel="stylesheet">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Videoclub</a>
            </div>
        </nav>

        <div class="container mt-5">
            <h2 class="text-center mb-4">Lista de Películas</h2>
            <div class="card">
                <div class="card-table">
                    <div class="card-table-row card-table-heading">
                        <div class="card-table-cell">Cartel</div>
                        <div class="card-table-cell">Título</div>
                        <div class="card-table-cell">Género</div>
                        <div class="card-table-cell">Año</div>
                        <div class="card-table-cell">País</div>
                        <div class="card-table-cell">Reparto</div>
                    </div>
                    <!-- Ejemplo de información de película -->
                    <div class="card-table-row">
                        <div class="card-table-cell"><img src="./assets/images/1302402.jpg" alt="Cartel de la película" class="cartel-image"></div>
                        <div class="card-table-cell">Título de la película</div>
                        <div class="card-table-cell">Acción</div>
                        <div class="card-table-cell">2023</div>
                        <div class="card-table-cell">Estados Unidos</div>
                        <div class="card-table-cell">
                            <div class="d-inline-flex align-items-center">
                                <img src="./assets/images/1302402.jpg" alt="Actor 1" class="actor-image">
                                <p class="mx-2">Nombre del actor 1</p>
                            </div>
                            <div class="d-inline-flex align-items-center">
                                <img src="./assets/images/1302402.jpg" alt="Actor 2" class="actor-image">
                                <p class="mx-2">Nombre del actor 2</p>
                            </div>
                        </div>
                    </div>
                    <!-- Fin del ejemplo de información de película -->
                </div>
            </div>
        </div>

        <div class="container suggestion-box">
            <h2 class="text-center mb-4 mt-5">Buzón de Sugerencias</h2>
            <form>
                <div class="mb-3">
                    <label for="suggestion" class="form-label">Tu sugerencia</label>
                    <textarea class="form-control" id="suggestion" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-danger">Enviar Sugerencia</button>
            </form>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    </body>
</html>
