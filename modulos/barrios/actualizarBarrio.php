<?php
    require('../../assets/server/conexion.php');
    session_start();

    // Verificar si se recibieron los datos del formulario de edición
    if(isset($_POST['id'])){
        //Obteniendo los valores para la edicion
        $id_barrio = $_POST['id'];
        $barrio = $_POST['barrio'];

        $query = "UPDATE barrios SET nombre_barrio = '$barrio' WHERE id_barrio = $id_barrio";

        if(mysqli_query($conn, $query)){
            $_SESSION['mensaje'] = "Datos actualizados correctamente";
            header("Location: listaBarrios.php");
            exit();
        }else{
            $_SESSION['mensaje'] = "No se pudo actualizar";
            header("Location: listaBarrios.php");
            exit();
        }
    }else{
        echo "Error: los datos del formuario no fueron recibidos correctamente";
    }

    mysqli_close($conn);

?>