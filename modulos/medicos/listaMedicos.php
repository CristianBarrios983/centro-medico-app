<?php
    session_start();

    // Verificar si el usuario ha iniciado sesión y si existe su rol en la sesión
    if(isset($_SESSION['rol'])){
      $rolUsuario = $_SESSION['rol'];

      if($rolUsuario == 1 || $rolUsuario == 2){
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista medicos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  </head>
  <body>
    <?php include('../../menu.php'); ?>
    <div class="container mt-4">
        <h1>Lista medicos</h1>

         <!-- Botón de registro -->
         <?php if($rolUsuario == 1): ?>
         <div class="d-flex justify-content-start mb-3">
            <a href="registroMedico.php" class="btn btn-primary">Registrar medico</a>
        </div>
        <?php endif; ?>

        <!-- Buscador -->
        <div class="d-flex justify-content-end mb-3">
            <form action="buscarMedicos.php" method="get">
                <label for="" class="form-label">Buscar por nombre o por apellido</label>
                <input type="text" class="form-control" id="busqueda" name="busqueda">
                <button type="submit" class="btn btn-success mt-2">Buscar</button>
            </form>
        </div>

        <?php
            //Conexion a la base de datos
            require('../../assets/server/conexion.php');

            //Consulta para obtener los datos de las personas
            $query = "SELECT m.id_medico, m.matricula_medico, p.*, d.tipo_documento, d.numero_documento, d.cuil, d.nro_seg_social, di.residencia, dc.*, es.id_especialidad, es.nombre_especialidad
            FROM medicos m 
            JOIN personas p ON m.id_persona = p.id_persona 
            JOIN documentaciones d ON p.id_documento = d.id_documento 
            JOIN datos_contactos dc ON dc.id_persona = p.id_persona 
            JOIN direcciones di ON dc.id_direccion = di.id_direccion 
            JOIN espxmedicos em ON m.id_medico = em.id_medico
            JOIN especialidades es ON em.id_especialidad = es.id_especialidad";
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
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Sexo</th>
                            <th>Matricula</th>
                            <th>Especialidad</th>
                            <th colspan="3">Opciones</th>
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
                            <?php if($rolUsuario == 1): ?>
                            <td><a href="verPerfilMedico.php?id=<?php echo $row['id_persona']; ?>" class="btn btn-info">Ver datos</a></td>
                            <td><a href="editarMedicoForm.php?id=<?php echo $row['id_persona']; ?>" class="btn btn-success">Editar</a></td>
                            <td><a href="eliminarMedico.php?id=<?php echo $row['id_persona']; ?>" class="btn btn-danger">Eliminar</a></td>
                            <?php endif; ?>
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