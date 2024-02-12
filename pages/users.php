<?php
session_start();
include("../lib/functions/functions.php");
if (!isset($_SESSION["user"]) && !isset($_SESSION["password"])) {
    header("Location:../index.php");
} else {
    if ($_SESSION["rol"] == 1) {
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
                    <?php
                    $peliculas = getMovies();
                    foreach ($peliculas as $pelicula) {
                        ?>
                        <div class="card-table-row">
                            <div class="card-table-cell"><img src="../assets/images/<?php echo $pelicula->getCartel() ?>" alt="Cartel de la película" class="cartel-image"></div>
                            <div class="card-table-cell"><?php echo $pelicula->getTitulo() ?></div>
                            <div class="card-table-cell"><?php echo $pelicula->getGenero() ?></div>
                            <div class="card-table-cell"><?php echo $pelicula->getAnyo() ?></div>
                            <div class="card-table-cell"><?php echo $pelicula->getPais() ?></div>
                            <div class="card-table-cell">
                                <?php
                                $actores = getActorsFromMovie($pelicula);
                                foreach ($actores as $actor) {
                                    ?>
                                    <div class="d-inline-flex align-items-center">
                                        <img src="../assets/images/<?php echo $actor->getFotografia() ?>" alt="Actor 1" class="actor-image">
                                        <p class="mx-2"><?php echo $actor->getNombre() . " " . $actor->getApellidos(); ?></p>

                                    </div>
                                    <?php
                                }
                                ?>

                            </div>
                            <div class="card-table-cell">
                                <button class="btn btn-danger">Eliminar</button>
                                <button class="btn btn-warning mt-1">Modificar</button>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
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
