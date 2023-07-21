<?php
    session_start();
    require("../../assets/server/conexion.php");

    $especialidad = $_POST['especialidad'];

    $queryCheckEspecialidad = "SELECT * FROM especialidades WHERE nombre_especialidad = '$especialidad'";
    $resultCheckEspecialidad = mysqli_query($conn, $queryCheckEspecialidad);

    if(mysqli_num_rows($resultCheckEspecialidad) > 0){
        //El email ya existe en la base de datos, se muestra el mensaje de error
        $_SESSION['mensaje'] = "La especialidad ya esta registrada";
        header("Location: registroEspecialidad.php");
        exit();
    }else{

        $query="INSERT INTO especialidades(nombre_especialidad) VALUES ('$especialidad')";

                if (mysqli_query($conn,$query)) {
                    $_SESSION['mensaje'] = "Registrado exitosamente";
                    header("Location: listaEspecialidades.php");
                    exit();
                }else{
                    $_SESSION['mensaje'] = "No se pudo registrar";
                    header("Location: registroEspecialidad.php");
                    exit();
                    //echo 'Se produjo un error'. mysqli_error();
                }
            }

    mysqli_close($conn);

?>