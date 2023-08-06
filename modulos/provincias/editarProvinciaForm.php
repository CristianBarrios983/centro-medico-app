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
    <title>Editar Provincia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    <div class="container mt-4 d-flex justify-content-center align-items-center" style="height: 100vh;">

    <?php
      require("../../assets/server/conexion.php");
        
      // Obtener el ID del registro a editar (puedes obtenerlo de la URL o de un formulario anterior)
      $id_provincia = $_GET['id'];

      // Consulta para obtener los datos del registro a editar
      $query = "SELECT provincias.*, paises.nombre_pais FROM provincias 
      JOIN paises ON provincias.id_pais = paises.id_pais WHERE id_provincia = $id_provincia";
      $result = mysqli_query($conn, $query);

      if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
      
    ?>
      <form action="actualizarProvincia.php" method="post" style="width: 20rem;" class="bg-white p-3 rounded-2" id="loginForm">
      <h3>Actualizar pais</h3>
            <input type="hidden" id="id" name="id" value="<?php echo $row['id_provincia']; ?>">
            <div class="mb-3">
                <label for="provincia" class="form-label">Provincia:</label>
                <input type="text" class="form-control" id="provincia" name="provincia" aria-describedby="emailHelp" value="<?php echo $row['nombre_provincia']; ?>">
              </div>
              <div class="mb-3">
                <label for="pais" class="form-label">Pais al que pertenece:</label>
                <?php 
                    require('../../assets/server/conexion.php');

                    $query = "SELECT id_pais, nombre_pais FROM paises";
                    $result = mysqli_query($conn,$query);
                ?>
                <select class="form-select" aria-label="Default select example" id="pais" name="pais">
                    <option selected value="<?php echo $row['id_pais']; ?>"><?php echo $row['nombre_pais'] ?></option>
                    <?php
                         while($fila = mysqli_fetch_assoc($result)):
                            if($fila['nombre_pais'] != $row['nombre_pais']):
                    ?>
                    <option value="<?php echo $fila['id_pais']; ?>"><?php echo $fila['nombre_pais']; ?></option>
                    <?php
                            endif; 
                        endwhile; 
                    ?>
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Editar</button>
              <a href="listaProvincias.php" class="btn btn-danger">Volver atras</a>
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