<?php
    require('../../assets/server/conexion.php');
    session_start();

    // Verificar si se recibieron los datos del formulario de edición
    if(isset($_POST['id'])){
        //Obteniendo los valores para la edicion
        $id_provincia = $_POST['id'];
        $provincia = $_POST['provincia'];
        $id_pais = $_POST['pais'];

        $query = "UPDATE provincias SET nombre_provincia = '$provincia', id_pais = $id_pais WHERE id_provincia = $id_provincia";

        if(mysqli_query($conn, $query)){
            $_SESSION['mensaje'] = "Datos actualizados correctamente";
            header("Location: listaProvincias.php");
            exit();
        }else{
            $_SESSION['mensaje'] = "No se pudo actualizar";
            header("Location: listaProvincias.php");
            exit();
        }
    }else{
        echo "Error: los datos del formuario no fueron recibidos correctamente";
    }

    mysqli_close($conn);

?>