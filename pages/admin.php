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
                            <a class="nav-link btn-cerrar-sesion"style="color: white;" href="./closeSesion.php">Cerrar sesión</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container mt-5">
            <h1 class="text-center">¡Bienvenido <?php echo $_SESSION["user"] ?>!</h1> 
            <?php
            // Leer la cookie de la última fecha de acceso
            if (isset($_COOKIE["lastAccess"])) {
                $lastAccess = $_COOKIE["lastAccess"];
                echo "<h2 class='text-center'>Última visita: $lastAccess</h2>";
            } else {
                echo "<h2 class='text-center'>No se ha establecido la última fecha de acceso.</h2>";
            }
            ?>
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
                        <form action="addMovie.php" method="post">
                            <div class="mb-3">
                                <label for="cartel" class="form-label">Cartel</label>
                                <input type="text" class="form-control" id="cartel" name="cartel" placeholder="Ingrese el cartel de la película">
                            </div>
                            <div class="mb-3">
                                <label for="titulo" class="form-label">Título</label>
                                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Ingrese el título de la película">
                            </div>
                            <div class="mb-3">
                                <label for="genero" class="form-label">Género</label>
                                <input type="text" class="form-control" id="genero" name="genero" placeholder="Ingrese el género de la película">
                            </div>
                            <div class="mb-3">
                                <label for="año" class="form-label">Año</label>
                                <input type="text" class="form-control" id="año" name="anyo" placeholder="Ingrese el año de la película">
                            </div>
                            <div class="mb-3">
                                <label for="pais" class="form-label">País</label>
                                <input type="text" class="form-control" id="pais" name="pais" placeholder="Ingrese el país de la película">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Añadir</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <?php
        if (isset($_GET["error"]) && $_GET["error"] == "incompleto") {
            ?>
            <div class = "alert alert-danger alert-dismissible fade show" role = "alert" style = "margin-top: 20px;">
                No has introducido todos los datos para añadir una película, por favor vuelve a intentarlo.
                <button type = "button" class = "btn-close" data-bs-dismiss = "alert" aria-label = "Close"></button>
            </div>
            <?php
        }
        ?>




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
                            <div class="card-table-cell"><img src="../assets/images/<?php echo $pelicula->getCartel() ?>" class="cartel-image"></div>
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
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#eliminarModal<?php echo $pelicula->getId() ?>">Eliminar</button>
                                <!-- Modal de Eliminar -->
                                <div class="modal fade" id="eliminarModal<?php echo $pelicula->getId() ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Eliminar Película</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                ¿Estás seguro que deseas eliminar esta película?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <a class="btn btn-danger" href="./deleteMovie.php?id=<?php echo $pelicula->getId() ?>" style="text-decoration: none; color: white;">Eliminar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-warning mt-1" data-bs-toggle="modal" data-bs-target="#modificarModal<?php echo $pelicula->getId() ?>">Modificar</button>

                                <!-- Modal de Modificar -->
                                <div class="modal fade" id="modificarModal<?php echo $pelicula->getId() ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modificar Película</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="editMovie.php" method="post">
                                                    <input type="hidden" name="id" value="<?php echo $pelicula->getId() ?>">
                                                    <div class="mb-3">
                                                        <label for="cartel" class="form-label">Cartel</label>
                                                        <input type="text" class="form-control" id="cartel" name="cartel" value="<?php echo $pelicula->getCartel() ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="titulo" class="form-label">Título</label>
                                                        <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $pelicula->getTitulo() ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="genero" class="form-label">Género</label>
                                                        <input type="text" class="form-control" id="genero" name="genero" value="<?php echo $pelicula->getGenero() ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="año" class="form-label">Año</label>
                                                        <input type="text" class="form-control" id="año" name="anyo" value="<?php echo $pelicula->getAnyo() ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="pais" class="form-label">País</label>
                                                        <input type="text" class="form-control" id="pais" name="pais" value="<?php echo $pelicula->getPais() ?>">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <button type="submit" class="btn btn-warning">Guardar Cambios</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
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
