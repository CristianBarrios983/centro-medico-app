<?php
    require('../../assets/server/conexion.php');
    session_start();

    // Verificar si se recibieron los datos del formulario de edición
    if(isset($_POST['id']) && isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['sex']) && isset($_POST['tipo_doc']) && isset($_POST['num_doc']) && isset($_POST['cuil']) && isset($_POST['num_seg_social']) && isset($_POST['num_tel']) && isset($_POST['matricula']) && isset($_POST['residencia']) && isset($_POST['id_doc']) && isset($_POST['id_contacto']) && isset($_POST['id_direccion'])){
        //Obteniendo los valores para la edicion
        $id_registro = $_POST['id'];
        $id_documento = $_POST['id_doc'];
        $id_contacto = $_POST['id_contacto'];
        $id_direccion = $_POST['id_direccion'];
        $id_medico = $_POST['id_medico'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $sex = $_POST['sex'];
        $tipo_doc = $_POST['tipo_doc'];
        $num_doc = $_POST['num_doc'];
        $cuil = $_POST['cuil'];
        $num_seg_social = $_POST['num_seg_social'];
        $telefono = $_POST['num_tel'];
        $matricula = $_POST['matricula'];
        $residencia = $_POST['residencia'];
        $especialidad = $_POST['especialidad'];

        $query = "UPDATE personas SET nombre = '$name', apellido = '$surname', sexo = '$sex' WHERE id_persona = $id_registro";
        $result = mysqli_query($conn, $query);

        $query2 = "UPDATE medicos SET matricula_medico = '$matricula' WHERE id_persona = $id_registro";
        $result2 = mysqli_query($conn, $query2);

        $query3 = "UPDATE documentaciones SET tipo_documento = '$tipo_doc', numero_documento = '$num_doc', cuil = $cuil, nro_seg_social = '$num_seg_social' WHERE id_documento = $id_documento";
        $result3 = mysqli_query($conn, $query3);

        $query4 = "UPDATE datos_contactos SET telefono = $telefono WHERE id_contactos = $id_contacto";
        $result = mysqli_query($conn, $query4);

        $query5 = "UPDATE direcciones SET residencia = '$residencia' WHERE id_direccion = $id_direccion";
        $result5 = mysqli_query($conn, $query5);

        $query6 = "UPDATE espxmedicos SET id_especialidad = $especialidad WHERE id_medico = $id_medico";
        $result6 = mysqli_query($conn, $query6);

        if(mysqli_query($conn, $query6)){
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