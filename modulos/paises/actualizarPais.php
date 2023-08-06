<?php
    require('../../assets/server/conexion.php');
    session_start();

    // Verificar si se recibieron los datos del formulario de edición
    if(isset($_POST['id'])){
        //Obteniendo los valores para la edicion
        $id_pais = $_POST['id'];
        $pais = $_POST['pais'];

        $query = "UPDATE paises SET nombre_pais = '$pais' WHERE id_pais = $id_pais";

        if(mysqli_query($conn, $query)){
            $_SESSION['mensaje'] = "Datos actualizados correctamente";
            header("Location: listaPaises.php");
            exit();
        }else{
            $_SESSION['mensaje'] = "No se pudo actualizar";
            header("Location: listaPaises.php");
            exit();
        }
    }else{
        echo "Error: los datos del formuario no fueron recibidos correctamente";
    }

    mysqli_close($conn);

?>