<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Iniciar Sesión</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="./css/style.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <h2 class="text-center mb-4">VideoClub Alejandro</h2>
            <form action="./pages/validateLogin.php" method="POST">
                <div class="mb-3">
                    <label for="user" class="form-label">Usuario</label>
                    <input type="text" class="form-control" id="user" name="user" placeholder="Usuario" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
                </div>
                <button type="submit" class="btn btn-danger btn-block">Iniciar Sesión</button>
            </form>
            <?php
            if (isset($_GET["login"]) && $_GET["login"] == "incorrecto") {
                ?>
                <div class="alert alert-danger mt-3" role="alert"">
                    El usuario o la contraseña son incorrectos. Por favor, inténtalo de nuevo.
                </div>
                <?php
            }
            ?>

        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    </body>
</html>