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
    <title>Editar Calle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    <div class="container mt-4 d-flex justify-content-center align-items-center" style="height: 100vh;">

    <?php
      require("../../assets/server/conexion.php");
        
      // Obtener el ID del registro a editar (puedes obtenerlo de la URL o de un formulario anterior)
      $id_calle = $_GET['id'];

      // Consulta para obtener los datos del registro a editar
      $query = "SELECT * FROM calles WHERE id_calle = $id_calle";
      $result = mysqli_query($conn, $query);

      if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
      
    ?>
      <form action="actualizarCalle.php" method="post" style="width: 20rem;" class="bg-white p-3 rounded-2" id="loginForm">
      <h3>Actualizar pais</h3>
            <input type="hidden" id="id" name="id" value="<?php echo $row['id_calle']; ?>">
            <div class="mb-3">
                <label for="calle" class="form-label">Calle:</label>
                <input type="text" class="form-control" id="calle" name="calle" aria-describedby="emailHelp" value="<?php echo $row['nombre_calle']; ?>">
              </div>
              <div class="mb-3">
                <label for="altura" class="form-label">Altura:</label>
                <input type="text" class="form-control" id="altura" name="altura" aria-describedby="emailHelp" value="<?php echo $row['altura_calle']; ?>">
              </div>
              <button type="submit" class="btn btn-primary">Editar</button>
              <a href="listaCalles.php" class="btn btn-danger">Volver atras</a>
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