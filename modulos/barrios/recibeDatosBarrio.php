<?php
    session_start();
    require("../../assets/server/conexion.php");

    $barrio = $_POST['barrio'];

    $queryCheckBarrio = "SELECT * FROM barrios WHERE nombre_barrio = '$barrio'";
    $resultCheckBarrio = mysqli_query($conn, $queryCheckBarrio);

    if(mysqli_num_rows($resultCheckBarrio) > 0){
        //El email ya existe en la base de datos, se muestra el mensaje de error
        $_SESSION['mensaje'] = "El barrio ya esta registrado";
        header("Location: registroBarrio.php");
        exit();
    }else{

        $query="INSERT INTO barrios(nombre_barrio) VALUES ('$barrio')";

                if (mysqli_query($conn,$query)) {
                    $_SESSION['mensaje'] = "Registrado exitosamente";
                    header("Location: listaBarrios.php");
                    exit();
                }else{
                    $_SESSION['mensaje'] = "No se pudo registrar";
                    header("Location: registroBarrios.php");
                    exit();
                    //echo 'Se produjo un error'. mysqli_error();
                }
            }

    mysqli_close($conn);

?>