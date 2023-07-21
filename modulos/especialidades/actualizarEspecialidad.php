<?php
    require('../../assets/server/conexion.php');
    session_start();

    // Verificar si se recibieron los datos del formulario de edición
    if(isset($_POST['id'])){
        //Obteniendo los valores para la edicion
        $id_especialidad = $_POST['id'];
        $especialidad = $_POST['especialidad'];

        $query = "UPDATE especialidades SET nombre_especialidad = '$especialidad' WHERE id_especialidad = $id_especialidad";

        if(mysqli_query($conn, $query)){
            $_SESSION['mensaje'] = "Datos actualizados correctamente";
            header("Location: listaEspecialidades.php");
            exit();
        }else{
            $_SESSION['mensaje'] = "No se pudo actualizar";
            header("Location: listaEspecialidades.php");
            exit();
        }
    }else{
        echo "Error: los datos del formuario no fueron recibidos correctamente";
    }

    mysqli_close($conn);

?>