<?php
    session_start();
    require("../../assets/server/conexion.php");

    $provincia = $_POST['provincia'];
    $idPais = $_POST['pais'];

    $queryCheckProvincia = "SELECT * FROM provincias WHERE nombre_provincia = '$provincia'";
    $resultCheckProvincia = mysqli_query($conn, $queryCheckProvincia);

    if(mysqli_num_rows($resultCheckProvincia) > 0){
        //El email ya existe en la base de datos, se muestra el mensaje de error
        $_SESSION['mensaje'] = "La provincia ya esta registrada";
        header("Location: registroProvincia.php");
        exit();
    }else{

        $query="INSERT INTO provincias(nombre_provincia, id_pais) VALUES ('$provincia', $idPais)";

                if (mysqli_query($conn,$query)) {
                    $_SESSION['mensaje'] = "Registrado exitosamente";
                    header("Location: listaProvincias.php");
                    exit();
                }else{
                    $_SESSION['mensaje'] = "No se pudo registrar";
                    header("Location: registroProvincias.php");
                    exit();
                    //echo 'Se produjo un error'. mysqli_error();
                }
            }

    mysqli_close($conn);

?>