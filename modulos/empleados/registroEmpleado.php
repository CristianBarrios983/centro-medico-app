<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro empleado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body class="bg-info-subtle">
<div class="container d-flex justify-content-center align-items-center mt-5 mb-5">
        <form action="recibeDatosEmpleado.php" method="post" style="width: 20rem;" class="bg-white p-3 rounded-2" id="registerForm">
        <?php
            // En el formulario de inicio de sesión (index.php)
            session_start();

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
            <h3>Registro empleado</h3>
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="name" name="name">
                <span id="nameError" class="text-danger error-message"></span>
            </div>
            <div class="mb-3">
                <label for="surname" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="surname" name="surname">
                <span id="surnameError" class="text-danger error-message"></span>
            </div>
            <div class="mb-3">
                <label for="tipo_doc" class="form-label">Tipo de documento</label>
                <input type="text" class="form-control" id="tipo_doc" name="tipo_doc">
                <span id="surnameError" class="text-danger error-message"></span>
            </div>
            <div class="mb-3">
                <label for="num_doc" class="form-label">Num documento</label>
                <input type="text" class="form-control" id="num_doc" name="num_doc">
                <span id="surnameError" class="text-danger error-message"></span>
            </div>
            <div class="mb-3">
                <label for="cuil" class="form-label">CUIL</label>
                <input type="text" class="form-control" id="cuil" name="cuil">
                <span id="surnameError" class="text-danger error-message"></span>
            </div>
            <div class="mb-3">
                <label for="num_seg_social" class="form-label">Num seguro social</label>
                <input type="text" class="form-control" id="num_seg_social" name="num_seg_social">
                <span id="surnameError" class="text-danger error-message"></span>
            </div>
            <div class="mb-3">
                <label for="num_tel" class="form-label">Num telefono</label>
                <input type="text" class="form-control" id="num_tel" name="num_tel">
                <span id="surnameError" class="text-danger error-message"></span>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo electronico</label>
                <input type="text" class="form-control" id="email" name="email">
                <span id="emailError" class="text-danger error-message"></span>
              </div>
              <div class="mb-3">
                <label for="sex" class="form-label">Sexo</label>
                <select class="form-select" aria-label="Default select example" id="sex" name="sex">
                    <option selected>Seleccione su sexo</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                    <option value="Otro">Otro</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="puesto_trabajo" class="form-label">Puesto de trabajo</label>
                <?php 
                    require('../../assets/server/conexion.php');

                    $query = "SELECT id_puesto_trabajo, nombre_puesto_trabajo FROM puestos_trabajos";
                    $result = mysqli_query($conn,$query);
                ?>
                <select class="form-select" aria-label="Default select example" id="puesto_trabajo" name="puesto_trabajo">
                    <option selected>Seleccione un puesto</option>
                    <?php
                         while($row = mysqli_fetch_assoc($result)):
                    ?>
                    <option value="<?php echo $row['id_puesto_trabajo']; ?>"><?php echo $row['nombre_puesto_trabajo']; ?></option>
                    <?php endwhile; ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="residencia" class="form-label">Residencia</label>
                <input type="text" class="form-control" id="residencia" name="residencia">
              </div>
              <div class="mb-3">
                <label for="pass" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="pass" name="pass">
                <span id="passError" class="text-danger error-message"></span>
              </div>
              <button type="submit" class="btn btn-primary">Register</button>
              <a href="listaEmpleados.php" class="btn btn-success">Atras</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>