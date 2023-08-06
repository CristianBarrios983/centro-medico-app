<?php
    include('assets/server/conexion.php');

    $sql = "SELECT * FROM usuarios WHERE id_rol = 1";
    $result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body class="bg-info-subtle">
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <form action="assets/server/acceder.php" method="post" style="width: 20rem;" class="bg-white p-3 rounded-2" id="loginForm">
            <?php
            // En el formulario de inicio de sesión (index.php)
            session_start();

            // Verificar si hay un mensaje almacenado en la variable de sesión
            if (isset($_SESSION['mensaje'])) {
                $mensaje = $_SESSION['mensaje'];
                // Eliminar el mensaje de la variable de sesión para que no se muestre nuevamente
                unset($_SESSION['mensaje']);
            }
            ?>
            <?php if (isset($mensaje)) : ?>
                <div class="alert alert-dark" role="alert">
                    <?php echo $mensaje; ?>
                </div>
            <?php endif; ?>
            <h3>Login</h3>
            <div class="mb-3">
                <label for="email" class="form-label">Correo electronico:</label>
                <input type="text" class="form-control email" id="email" name="email" aria-describedby="emailHelp">
                <span id="emailError" class="text-danger error-message"></span>
              </div>
              <div class="mb-3">
                <label for="pass" class="form-label">Contraseña:</label>
                <input type="password" class="form-control pass" name="pass" id="pass">
                <span id="passError" class="text-danger error-message"></span>
              </div>
              <button type="submit" class="btn btn-primary">Entrar</button>
              <?php if(mysqli_num_rows($result) < 1): ?>
                    <a href="registro.php" class="btn btn-danger">Registrarse como admin</a>    
                <?php endif; ?>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>