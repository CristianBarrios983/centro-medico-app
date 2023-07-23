<?php
    session_start();

    //Verifica si la sesion esta iniciada
    if(!isset($_SESSION['email'])){
      //Redirigir a la pagina de login
      header("Location: index.php");
      exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de control</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
    <?php 
        include ('menu.php');
    ?>

    <!-- Tarjetas de informacion -->
    <div class="container">
        <h2 class="mt-4">Panel de control</h2>
        <div class="row">
            <div class="col-md-3">
                <div class="card text-bg-primary mb-3" style="max-width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Medicos</h5>
                        <?php 
                            require('assets/server/conexion.php');

                            //Se realiza la consulta para contar el numero de usuarios
                            $query = "SELECT COUNT(*) AS total_medicos FROM medicos";
                            $result = mysqli_query($conn, $query);

                            //Obtener el resultado de la consulta
                            $row = mysqli_fetch_assoc($result);
                            $total_medicos = $row['total_medicos'];
                        ?>
                        <p class="card-text"><?php echo $total_medicos; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-bg-success mb-3" style="max-width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Empleados</h5>
                        <?php 
                            require('assets/server/conexion.php');

                            //Se realiza la consulta para contar el numero de usuarios
                            $query = "SELECT COUNT(*) AS total_empleados FROM empleados";
                            $result = mysqli_query($conn, $query);

                            //Obtener el resultado de la consulta
                            $row = mysqli_fetch_assoc($result);
                            $total_empleados = $row['total_empleados'];
                        ?>
                        <p class="card-text"><?php echo $total_empleados ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-bg-danger mb-3" style="max-width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Pacientes</h5>
                        <?php 
                            require('assets/server/conexion.php');

                            //Se realiza la consulta para contar el numero de usuarios
                            $query = "SELECT COUNT(*) AS total_pacientes FROM pacientes";
                            $result = mysqli_query($conn, $query);

                            //Obtener el resultado de la consulta
                            $row = mysqli_fetch_assoc($result);
                            $total_pacientes = $row['total_pacientes'];
                        ?>
                        <p class="card-text"><?php echo $total_pacientes; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-bg-warning mb-3" style="max-width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Especialidades</h5>
                        <?php 
                            require('assets/server/conexion.php');

                            //Se realiza la consulta para contar el numero de usuarios
                            $query = "SELECT COUNT(*) AS total_especialidades FROM especialidades";
                            $result = mysqli_query($conn, $query);

                            //Obtener el resultado de la consulta
                            $row = mysqli_fetch_assoc($result);
                            $total_especialidades = $row['total_especialidades'];
                        ?>
                        <p class="card-text"><?php echo $total_especialidades ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>