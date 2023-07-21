<?php
    session_start();
    require("../../assets/server/conexion.php");

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $sex = $_POST['sex'];
    $pass = $_POST['pass'];
    $matricula = $_POST['matricula'];

    $queryCheckEmail = "SELECT * FROM usuarios WHERE email = '$email'";
    $resultCheckEmail = mysqli_query($conn, $queryCheckEmail);

    if(mysqli_num_rows($resultCheckEmail) > 0){
        //El email ya existe en la base de datos, se muestra el mensaje de error
        $_SESSION['mensaje'] = "El email ingresado ya está en uso";
        header("Location: registroMedico.php");
        exit();
    }else{
        //Si el email no se encuentra en la base de datos, se procede con el registro
        $hash = password_hash($pass, PASSWORD_DEFAULT);

        $query="INSERT INTO personas(nombre,apellido,sexo) VALUES ('$name','$surname','$sex')";

        if(mysqli_query($conn,$query)){
            $id_persona = mysqli_insert_id($conn); // Obtenemos el ID de la persona insertada

            $query = "INSERT INTO medicos(id_persona,matricula_medico) VALUES ($id_persona,'$matricula')";
        
            if(mysqli_query($conn, $query)){
            
                $sql="INSERT INTO usuarios(email,pass,id_persona) VALUES ('$email','$hash',$id_persona)";

                if (mysqli_query($conn,$sql)) {
                    $_SESSION['mensaje'] = "Registrado exitosamente";
                    header("Location: listaMedicos.php");
                    exit();
                }else{
                    $_SESSION['mensaje'] = "No se pudo registrar";
                    header("Location: registroMedico.php");
                    exit();
                    //echo 'Se produjo un error'. mysqli_error();
                }
            }
        }
    }

    mysqli_close($conn);

?>