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
    <title>Perfil Medico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body class="bg-info-subtle">
    
    <div class="container d-flex justify-content-center align-items-center">
        <?php
        require("../../assets/server/conexion.php");
            
        // Obtener el ID del registro a editar (puedes obtenerlo de la URL o de un formulario anterior)
        $id_registro = $_GET['id'];

        // Consulta para obtener los datos del registro a editar
        $query = "SELECT m.id_medico, m.matricula_medico, p.*, d.tipo_documento, d.numero_documento, d.cuil, d.nro_seg_social, di.residencia, dc.*, es.id_especialidad, es.nombre_especialidad
        FROM medicos m 
        JOIN personas p ON m.id_persona = p.id_persona 
        JOIN documentaciones d ON p.id_documento = d.id_documento 
        JOIN datos_contactos dc ON dc.id_persona = p.id_persona 
        JOIN direcciones di ON dc.id_direccion = di.id_direccion 
        JOIN espxmedicos em ON m.id_medico = em.id_medico
        JOIN especialidades es ON em.id_especialidad = es.id_especialidad
        WHERE p.id_persona = $id_registro";
        
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_assoc($result);
        
        ?>
       <div class="card mt-5">
        <h5 class="card-header">Perfil medico</h5>
        <div class="card-body">
            <h5 class="card-title mb-4 text-primary"><?php echo $row['nombre'] ." ". $row['apellido'];  ?></h5>
            <p class="card-text"><b>Tipo de documento:</b> <?php echo $row['tipo_documento']; ?></p>
            <p class="card-text"><b>N° de documento:</b> <?php echo $row['numero_documento']; ?></p>
            <p class="card-text"><b>CUIL:</b> <?php echo $row['cuil']; ?></p>
            <p class="card-text"><b>N° seguro social:</b> <?php echo $row['nro_seg_social']; ?></p>
            <p class="card-text"><b>Telefono:</b> <?php echo $row['telefono']; ?></p>
            <p class="card-text"><b>Sexo:</b> <?php echo $row['sexo']; ?></p>
            <p class="card-text"><b>Matricula:</b> <?php echo $row['matricula_medico']; ?></p>
            <p class="card-text"><b>Especialidad:</b><span class="badge text-bg-info ms-1"><?php echo $row['nombre_especialidad']; ?></span></p>
            <p class="card-text"><b>Residencia:</b> <?php echo $row['residencia']; ?></p>
            <a href="listaMedicos.php" class="btn btn-danger">Volver</a>
        </div>
       </div>
            <?php
        }else{
            echo "<p>Registro no encontrado</p>";
        }

        mysqli_close($conn);
            ?>
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