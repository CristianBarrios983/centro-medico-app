<?php
    session_start();
    require("../../assets/server/conexion.php");

    $pais = $_POST['pais'];

    $queryCheckPais = "SELECT * FROM paises WHERE nombre_pais = '$pais'";
    $resultCheckPais = mysqli_query($conn, $queryCheckPais);

    if(mysqli_num_rows($resultCheckPais) > 0){
        //El email ya existe en la base de datos, se muestra el mensaje de error
        $_SESSION['mensaje'] = "El pais ya esta registrado";
        header("Location: registroPais.php");
        exit();
    }else{

        $query="INSERT INTO paises(nombre_pais) VALUES ('$pais')";

                if (mysqli_query($conn,$query)) {
                    $_SESSION['mensaje'] = "Registrado exitosamente";
                    header("Location: listaPaises.php");
                    exit();
                }else{
                    $_SESSION['mensaje'] = "No se pudo registrar";
                    header("Location: registroPaises.php");
                    exit();
                    //echo 'Se produjo un error'. mysqli_error();
                }
            }

    mysqli_close($conn);

?>