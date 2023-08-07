<?php
// Verificar si se ha enviado el formulario de búsqueda
if (isset($_GET['busqueda'])) {
  // Obtener el valor del campo de búsqueda y almacenarla en una variable
  $busqueda = $_GET['busqueda'];

  // Validar si el campo de búsqueda está vacío
  if (empty($busqueda)) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Busqueda de calles</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    </head>
    <body>
        <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Por favor, ingresa el nombre de la calle para realizar la búsqueda.</h6>
                    <a href="listaCalles.php" class="btn btn-primary text-center">Volver</a>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    </body>
    </html>
<?php    
  } else {

    // Realizar la búsqueda en la base de datos
    require ('../../assets/server/conexion.php'); 

    $query = "SELECT * FROM calles
    WHERE nombre_calle LIKE '%$busqueda%'";

    $result = mysqli_query($conn, $query);

    // Verificar si se encontraron resultados en la búsqueda
    if (mysqli_num_rows($result) > 0) {
        // Mostrar los resultados de la búsqueda
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Busqueda de calle</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    </head>
    <body>
        <div class="container mt-4">
            <h5 class="mb-4">Resultados de busqueda</h5>
            <a href="listaCalles.php" class="btn btn-warning">Volver atras</a>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Calle</th>
                                    <th>Altura</th>
                                    <th colspan="2">Opciones</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                            <?php
                                while($row = mysqli_fetch_assoc($result)):
                            ?>

                                <tr>
                                    <td><?php echo $row['id_calle'];  ?></td>
                                    <td><?php echo $row['nombre_calle'];  ?></td>
                                    <td><?php echo $row['altura_calle'];  ?></td>
                                    <td><a href="editarCalleForm.php?id=<?php echo $row['id_calle']; ?>" class="btn btn-success">Editar</a></td>
                                    <td><a href="eliminarCalle.php?id=<?php echo $row['id_calle']; ?>" class="btn btn-danger">Eliminar</a></td>
                                </tr>
                            </tbody>
                            <?php endwhile; ?>
                        </table>
                    </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    </body>
    </html>    
  <?php    
    } else {
      ?>
      <!DOCTYPE html>
      <html lang="en">
      <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Busqueda de calles</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

      </head>
      <body>
      <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">No se encontraron resultados para la búsqueda.</h6>
                    <a href="listaCalles.php" class="btn btn-primary text-center">Volver</a>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

      </body>
      </html>
<?php
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
  }
}
?>