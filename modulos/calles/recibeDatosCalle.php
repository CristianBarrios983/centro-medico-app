<?php
    session_start();
    require("../../assets/server/conexion.php");

    $calle = $_POST['calle'];
    $altura = $_POST['altura'];

    $queryCheckCalle = "SELECT * FROM calles WHERE nombre_calle = '$calle'";
    $resultCheckCalle = mysqli_query($conn, $queryCheckCalle);

    if(mysqli_num_rows($resultCheckCalle) > 0){
        //El email ya existe en la base de datos, se muestra el mensaje de error
        $_SESSION['mensaje'] = "La calle ya esta registrada";
        header("Location: registroCalle.php");
        exit();
    }else{

        $query="INSERT INTO calles(nombre_calle, altura_calle) VALUES ('$calle', $altura)";

                if (mysqli_query($conn,$query)) {
                    $_SESSION['mensaje'] = "Registrado exitosamente";
                    header("Location: listaCalles.php");
                    exit();
                }else{
                    $_SESSION['mensaje'] = "No se pudo registrar";
                    header("Location: registroCalles.php");
                    exit();
                    //echo 'Se produjo un error'. mysqli_error();
                }
            }

    mysqli_close($conn);

?>