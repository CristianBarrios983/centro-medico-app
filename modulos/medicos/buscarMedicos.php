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
        <title>Busqueda de medicos</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    </head>
    <body>
        <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Por favor, ingresa un nombre o apellido para realizar la búsqueda.</h6>
                    <a href="listaMedicos.php" class="btn btn-primary text-center">Volver</a>
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

    $query = "SELECT m.id_medico, m.matricula_medico, p.*, d.tipo_documento, d.numero_documento, d.cuil, d.nro_seg_social, di.residencia, dc.*, es.id_especialidad, es.nombre_especialidad
    FROM medicos m 
    JOIN personas p ON m.id_persona = p.id_persona 
    JOIN documentaciones d ON p.id_documento = d.id_documento 
    JOIN datos_contactos dc ON dc.id_persona = p.id_persona 
    JOIN direcciones di ON dc.id_direccion = di.id_direccion 
    JOIN espxmedicos em ON m.id_medico = em.id_medico
    JOIN especialidades es ON em.id_especialidad = es.id_especialidad
    WHERE p.nombre LIKE '%$busqueda%' OR p.apellido LIKE '%$busqueda%'";

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
        <title>Busqueda de medicos</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    </head>
    <body>
        <div class="container mt-4">
            <h5 class="mb-4">Resultados de busqueda</h5>
            <a href="listaMedicos.php" class="btn btn-warning">Volver atras</a>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Sexo</th>
                                    <th>Matricula</th>
                                    <th>Especialidad</th>
                                    <th colspan="2">Opciones</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                            <?php
                                while($row = mysqli_fetch_assoc($result)):
                            ?>

                                <tr>
                                    <td><?php echo $row['id_persona'];  ?></td>
                                    <td><?php echo $row['nombre'];  ?></td>
                                    <td><?php echo $row['apellido'];  ?></td>
                                    <td><?php echo $row['sexo'];  ?></td>
                                    <td><?php echo $row['matricula_medico'];  ?></td>
                                    <td><?php echo $row['nombre_especialidad'];  ?></td>
                                    <td><a href="editarMedicoForm.php?id=<?php echo $row['id_persona']; ?>" class="btn btn-success">Editar</a></td>
                                    <td><a href="eliminarMedico.php?id=<?php echo $row['id_persona']; ?>" class="btn btn-danger">Eliminar</a></td>
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
        <title>Busqueda de medicos</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

      </head>
      <body>
      <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">No se encontraron resultados para la búsqueda.</h6>
                    <a href="listaMedicos.php" class="btn btn-primary text-center">Volver</a>
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