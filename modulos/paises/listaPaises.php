<?php
    session_start();

    // Verificar si el usuario ha iniciado sesión y si existe su rol en la sesión
    if(isset($_SESSION['rol'])){
      $rolUsuario = $_SESSION['rol'];

      if($rolUsuario == 1){
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista paises</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  </head>
  <body>
    <?php include('../../menu.php'); ?>
    <div class="container mt-4">
        <h1>Lista paises</h1>
         <!-- Botón de registro -->
         <div class="d-flex justify-content-start mb-3">
            <a href="registroPais.php" class="btn btn-primary">Registrar pais</a>
        </div>

        <!-- Buscador -->
        <div class="d-flex justify-content-end mb-3">
            <form action="buscarPaises.php" method="get">
                <label for="" class="form-label">Buscar por pais</label>
                <input type="text" class="form-control" id="busqueda" name="busqueda">
                <button type="submit" class="btn btn-success mt-2">Buscar</button>
            </form>
        </div>

        <?php
            //Conexion a la base de datos
            require('../../assets/server/conexion.php');

            //Consulta para obtener los datos de las personas
            $query = "SELECT * FROM paises";
            $result = mysqli_query($conn, $query);

            if(mysqli_num_rows($result) > 0){
        ?>

        <!-- Tabla centrada -->
        <div class="row justify-content-center">
        <?php
            // En el formulario de inicio de sesión (index.php)

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
            <div class="col-md-8">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Pais</th>
                            <th colspan="2">Opciones</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                    <?php
                        while($row = mysqli_fetch_assoc($result)):
                    ?>

                        <tr>
                            <td><?php echo $row['id_pais'];  ?></td>
                            <td><?php echo $row['nombre_pais'];  ?></td>
                            <td><a href="editarPaisForm.php?id=<?php echo $row['id_pais']; ?>" class="btn btn-success">Editar</a></td>
                            <td><a href="eliminarPais.php?id=<?php echo $row['id_pais']; ?>" class="btn btn-danger">Eliminar</a></td>
                        </tr>
                    </tbody>
                    <?php endwhile; ?>
                </table>
                <?php
            } else {
                // No hay registros, mostrar el mensaje
                echo "<p>No hay registros.</p>";
            }

        // Cerrar la conexión a la base de datos
        mysqli_close($conn);
        ?>
            </div>
        </div>
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