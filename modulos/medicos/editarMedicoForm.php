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
    <title>Editar Medico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body class="bg-info-subtle">
    <div class="container mt-4 d-flex justify-content-center align-items-center mt-5 mb-5">

    <?php
      require("../../assets/server/conexion.php");
        
      // Obtener el ID del registro a editar (puedes obtenerlo de la URL o de un formulario anterior)
      $id_registro = $_GET['id'];

      // Consulta para obtener los datos del registro a editar
      $query = "SELECT m.matricula_medico, p.*, d.tipo_documento, d.numero_documento, d.cuil, d.nro_seg_social, di.residencia, dc.* FROM medicos m JOIN personas p ON m.id_persona = p.id_persona JOIN documentaciones d ON p.id_documento = d.id_documento JOIN datos_contactos dc ON dc.id_persona = p.id_persona JOIN direcciones di ON dc.id_direccion = di.id_direccion WHERE p.id_persona = $id_registro";
      $result = mysqli_query($conn, $query);

      if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
      
    ?>
      <form action="actualizarDatos.php" method="post" style="width: 20rem;" class="bg-white p-3 rounded-2" id="loginForm">
      <h3>Actualizar datos</h3>
            <input type="hidden" id="id" name="id" value="<?php echo $row['id_persona']; ?>">
            <input type="hidden" id="id_doc" name="id_doc" value="<?php echo $row['id_documento']; ?>">
            <input type="hidden" id="id_contacto" name="id_contacto" value="<?php echo $row['id_contactos']; ?>">
            <input type="hidden" id="id_direccion" name="id_direccion" value="<?php echo $row['id_direccion']; ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" value="<?php echo $row['nombre']; ?>">
              </div>
              <div class="mb-3">
                <label for="surname" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="surname" name="surname" aria-describedby="emailHelp" value="<?php echo $row['apellido']; ?>">
              </div>
              <div class="mb-3">
                <label for="tipo_doc" class="form-label">Tipo de documento</label>
                <input type="text" class="form-control" id="tipo_doc" name="tipo_doc" value="<?php echo $row['tipo_documento']; ?>">
            </div>
            <div class="mb-3">
                <label for="num_doc" class="form-label">Num documento</label>
                <input type="text" class="form-control" id="num_doc" name="num_doc" value="<?php echo $row['numero_documento']; ?>">
            </div>
            <div class="mb-3">
                <label for="cuil" class="form-label">CUIL</label>
                <input type="text" class="form-control" id="cuil" name="cuil" value="<?php echo $row['cuil']; ?>">
            </div>
            <div class="mb-3">
                <label for="num_seg_social" class="form-label">Num seguro social</label>
                <input type="text" class="form-control" id="num_seg_social" name="num_seg_social" value="<?php echo $row['nro_seg_social']; ?>">
            </div>
            <div class="mb-3">
                <label for="num_tel" class="form-label">Num telefono</label>
                <input type="text" class="form-control" id="num_tel" name="num_tel" value="<?php echo $row['telefono']; ?>">
            </div>
              <div class="mb-3">
                <label for="sex" class="form-label">Sexo:</label>
                <?php
                  if($row['sexo'] === "Masculino"){
                    $sexo = "Femenino";
                    $sexo2 = "Otro";
                  }elseif($row['sexo'] === "Femenino"){
                    $sexo = "Masculino";
                    $sexo2 = "Otro";
                  }else{
                    $sexo = "Masculino";
                    $sexo2 = "Femenino";
                  }
                ?>
                <select class="form-select" aria-label="Default select example" name="sex">
                  <option selected><?php echo $row['sexo']; ?></option>
                  <option value="<?php echo $sexo; ?>"><?php echo $sexo; ?></option>
                  <option value="<?php echo $sexo2; ?>"><?php echo $sexo2; ?></option>
                </select>
              </div>
              <div class="mb-3">
                <label for="matricula" class="form-label">Matricula</label>
                <input type="text" class="form-control" id="matricula" name="matricula" value="<?php echo $row['matricula_medico']; ?>">
              </div>
              <div class="mb-3">
                <label for="residencia" class="form-label">Residencia</label>
                <input type="text" class="form-control" id="residencia" name="residencia" value="<?php echo $row['residencia']; ?>">
              </div>
              <button type="submit" class="btn btn-primary">Editar</button>
              <a href="listaMedicos.php" class="btn btn-danger">Volver atras</a>
        </form>
        <?php
      }else{
        echo "<p>Registro no encontrado</p>";
      }

      mysqli_close($conn);
        ?>
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