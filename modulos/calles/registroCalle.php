<?php
    session_start();

    // Verificar si el usuario ha iniciado sesión y si existe su rol en la sesión
    if(isset($_SESSION['rol'])){
      $rolUsuario = $_SESSION['rol'];

      if($rolUsuario == 1){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro calle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body class="bg-info-subtle">
<div class="container d-flex justify-content-center align-items-center mt-5 mb-5">
        <form action="recibeDatosCalle.php" method="post" style="width: 20rem;" class="bg-white p-3 rounded-2" id="registerForm">
        <?php

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
            <h3>Registro calle</h3>
            <div class="mb-3">
                <label for="calle" class="form-label">Calle</label>
                <input type="text" class="form-control" id="calle" name="calle">
                <span id="nameError" class="text-danger error-message"></span>
            </div>
            <div class="mb-3">
                <label for="altura" class="form-label">Altura</label>
                <input type="text" class="form-control" id="altura" name="altura">
                <span id="nameError" class="text-danger error-message"></span>
            </div>
              <button type="submit" class="btn btn-primary">Register</button>
              <a href="listaCalles.php" class="btn btn-success">Atras</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>

<?php
    }else{
        header("Location: ../../mensaje.php");
        exit();
      }
    }else{
        // El usuario no ha iniciado sesión, redirigir a una página de inicio de sesión
        header("Location: ../../index.php");
        exit();
    }
?>