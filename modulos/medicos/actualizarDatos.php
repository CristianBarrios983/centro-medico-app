<?php
    require('../../assets/server/conexion.php');
    session_start();

    // Verificar si se recibieron los datos del formulario de edición
    if(isset($_POST['id']) && isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['sex'])){
        //Obteniendo los valores para la edicion
        $id_registro = $_POST['id'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $sex = $_POST['sex'];

        $query = "UPDATE personas SET nombre = '$name', apellido = '$surname', sexo = '$sex' WHERE id_persona = $id_registro";

        if(mysqli_query($conn, $query)){
            $_SESSION['mensaje'] = "Datos actualizados correctamente";
            header("Location: listaMedicos.php");
            exit();
        }else{
            $_SESSION['mensaje'] = "No se pudo actualizar";
            header("Location: listaMedicos.php");
            exit();
        }
    }else{
        echo "Error: los datos del formuario no fueron recibidos correctamente";
    }

    mysqli_close($conn);

?>