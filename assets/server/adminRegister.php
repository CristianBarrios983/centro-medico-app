<?php
    session_start();
    require("conexion.php");

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $sex = $_POST['sex'];
    $pass = $_POST['pass'];
    $rol = $_POST['rol'];

    $queryCheckEmail = "SELECT * FROM usuarios WHERE email = '$email'";
    $resultCheckEmail = mysqli_query($conn, $queryCheckEmail);

    if(mysqli_num_rows($resultCheckEmail) > 0){
        //El email ya existe en la base de datos, se muestra el mensaje de error
        $_SESSION['mensaje'] = "El email ingresado ya está en uso";
        header("Location: ../../registro-admin.php");
        exit();
    }else{
        //Si el email no se encuentra en la base de datos, se procede con el registro
        $hash = password_hash($pass, PASSWORD_DEFAULT);

        $query="INSERT INTO personas(nombre,apellido,sexo) VALUES ('$name','$surname','$sex')";

        if(mysqli_query($conn,$query)){

            //$subquery="SELECT id_persona FROM personas WHERE nombre='$name' AND apellido='$surname'";
            $id_persona = mysqli_insert_id($conn); // Obtenemos el ID de la persona insertada
        
            $sql="INSERT INTO usuarios(id_rol,email,pass,id_persona) VALUES ($rol,'$email','$hash',$id_persona)";
        
            if (mysqli_query($conn,$sql)) {
                $_SESSION['mensaje'] = "Registrado exitosamente";
                header("Location: ../../index.php");
                exit();
            }else{
                $_SESSION['mensaje'] = "No se pudo registrar";
                header("Location: ../../index.php");
                exit();
                //echo 'Se produjo un error'. mysqli_error();
            }
        }
    }

    mysqli_close($conn);

?>