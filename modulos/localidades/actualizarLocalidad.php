<?php
    require('../../assets/server/conexion.php');
    session_start();

    // Verificar si se recibieron los datos del formulario de edición
    if(isset($_POST['id'])){
        //Obteniendo los valores para la edicion
        $id_localidad = $_POST['id'];
        $localidad = $_POST['localidad'];
        $codigoPostal = $_POST['codigo_postal'];

        $query = "UPDATE localidades SET nombre_localidad = '$localidad', codigo_postal = '$codigoPostal' WHERE id_localidad = $id_localidad";

        if(mysqli_query($conn, $query)){
            $_SESSION['mensaje'] = "Datos actualizados correctamente";
            header("Location: listaLocalidades.php");
            exit();
        }else{
            $_SESSION['mensaje'] = "No se pudo actualizar";
            header("Location: listaLocalidades.php");
            exit();
        }
    }else{
        echo "Error: los datos del formuario no fueron recibidos correctamente";
    }

    mysqli_close($conn);

?>