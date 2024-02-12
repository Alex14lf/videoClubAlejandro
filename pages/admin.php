<?php
session_start();
include("../lib/functions/functions.php");
if (!isset($_SESSION["user"]) && !isset($_SESSION["password"])) {
    header("Location:../index.php");
} else {
    if ($_SESSION["rol"] == 0) {
        header("Location:users.php");
    }
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>VideoClub</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/admin.css" rel="stylesheet">
    </head>
    <body>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Videoclub</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link btn-cerrar-sesion" href="#">Cerrar sesión</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container mt-5">
            <h1 class="text-center">¡Bienvenido!</h1> <!-- AÑADIR EL NOMBRE DE LA SESION -->
            <h2 class="text-center">Última visita: 2024-02-08</h2> <!-- AÑADIR LA COOKIE -->
            <!-- Agrega este botón donde quieras abrir el modal -->
            <button class="btn btn-primary mt-3 d-block mx-auto" data-bs-toggle="modal" data-bs-target="#exampleModal">Añadir Pelicula</button>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Añadir Película</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Aquí va el contenido del formulario -->
                        <form>
                            <form>
                                <div class="mb-3">
                                    <label for="cartel" class="form-label">Cartel</label>
                                    <input type="text" class="form-control" id="cartel" placeholder="Ingrese el cartel de la película">
                                </div>
                                <div class="mb-3">
                                    <label for="titulo" class="form-label">Título</label>
                                    <input type="text" class="form-control" id="titulo" placeholder="Ingrese el título de la película">
                                </div>
                                <div class="mb-3">
                                    <label for="genero" class="form-label">Género</label>
                                    <input type="text" class="form-control" id="genero" placeholder="Ingrese el género de la película">
                                </div>
                                <div class="mb-3">
                                    <label for="año" class="form-label">Año</label>
                                    <input type="text" class="form-control" id="año" placeholder="Ingrese el año de la película">
                                </div>
                                <div class="mb-3">
                                    <label for="pais" class="form-label">País</label>
                                    <input type="text" class="form-control" id="pais" placeholder="Ingrese el país de la película">
                                </div>
                            </form>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Añadir</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            <h3 class="text-center mb-4">Películas</h3>
            <div class="card">
                <div class="card-table">
                    <div class="card-table-row card-table-heading">
                        <div class="card-table-cell">Cartel</div>
                        <div class="card-table-cell">Título</div>
                        <div class="card-table-cell">Género</div>
                        <div class="card-table-cell">Año</div>
                        <div class="card-table-cell">País</div>
                        <div class="card-table-cell">Reparto</div>
                        <div class="card-table-cell">Acciones</div>
                    </div>
                    <?php
                    $peliculas = getMovies();
                    foreach ($peliculas as $pelicula) {
                        ?>
                        <div class="card-table-row">
                            <div class="card-table-cell"><img src="../assets/images/<?php echo $pelicula->getCartel()?>" alt="Cartel de la película" class="cartel-image"></div>
                            <div class="card-table-cell"><?php echo $pelicula->getTitulo()?></div>
                            <div class="card-table-cell"><?php echo $pelicula->getGenero()?></div>
                            <div class="card-table-cell"><?php echo $pelicula->getAnyo()?></div>
                            <div class="card-table-cell"><?php echo $pelicula->getPais()?></div>
                            <div class="card-table-cell">
                                <?php
                                $actores = getActorsFromMovie($pelicula);
                                foreach ($actores as $actor) {
                                    ?>
                                    <div class="d-inline-flex align-items-center">
                                        <img src="../assets/images/<?php echo $actor->getFotografia()?>" alt="Actor 1" class="actor-image">
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

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    </body>
</html>
