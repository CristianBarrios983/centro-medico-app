<?php
    session_start();
    require("../../assets/server/conexion.php");

    $localidad = $_POST['localidad'];
    $codigoPostal = $_POST['codigo_postal'];

    $queryCheckLocalidad = "SELECT * FROM localidades WHERE nombre_localidad = '$localidad'";
    $resultCheckLocalidad = mysqli_query($conn, $queryCheckLocalidad);

    if(mysqli_num_rows($resultCheckLocalidad) > 0){
        //El email ya existe en la base de datos, se muestra el mensaje de error
        $_SESSION['mensaje'] = "La localidad ya esta registrada";
        header("Location: registroLocalidad.php");
        exit();
    }else{

        $query="INSERT INTO localidades(nombre_localidad, codigo_postal) VALUES ('$localidad', '$codigoPostal')";

                if (mysqli_query($conn,$query)) {
                    $_SESSION['mensaje'] = "Registrado exitosamente";
                    header("Location: listaLocalidades.php");
                    exit();
                }else{
                    $_SESSION['mensaje'] = "No se pudo registrar";
                    header("Location: registroLocalidades.php");
                    exit();
                    //echo 'Se produjo un error'. mysqli_error();
                }
            }

    mysqli_close($conn);

?>