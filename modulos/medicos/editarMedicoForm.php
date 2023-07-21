<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Medico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    <div class="container mt-4 d-flex justify-content-center align-items-center" style="height: 100vh;">

    <?php
      require("../../assets/server/conexion.php");
        
      // Obtener el ID del registro a editar (puedes obtenerlo de la URL o de un formulario anterior)
      $id_registro = $_GET['id'];

      // Consulta para obtener los datos del registro a editar
      $query = "SELECT * FROM personas WHERE id_persona = $id_registro";
      $result = mysqli_query($conn, $query);

      if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
      
    ?>
      <form action="actualizarDatos.php" method="post" style="width: 20rem;" class="bg-white p-3 rounded-2" id="loginForm">
      <h3>Actualizar datos</h3>
            <input type="hidden" id="id" name="id" value="<?php echo $row['id_persona']; ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" value="<?php echo $row['nombre']; ?>">
              </div>
              <div class="mb-3">
                <label for="surname" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="surname" name="surname" aria-describedby="emailHelp" value="<?php echo $row['apellido']; ?>">
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