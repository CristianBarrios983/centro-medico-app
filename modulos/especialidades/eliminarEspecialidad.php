<?php
    require('../../assets/server/conexion.php');

    session_start();

    // ID del usuario que deseamos eliminar
    $id_especialidad = $_GET['id'];

    // Consulta para eliminar al usuario y sus comentarios relacionados
    $query = "DELETE FROM especialidades WHERE id_especialidad = $id_especialidad";

    // Ejecutar la consulta
    if (mysqli_query($conn, $query)) {
        $_SESSION['mensaje'] = "Se ha eliminado satisfactoriamente";
        header("Location: listaEspecialidades.php");
        exit();
    } else {
        $_SESSION['mensaje'] = "Error al eliminar";
        header("Location: listaEspecialidades.php");
        exit();
    }

    // Cerrar la conexión
    mysqli_close($conn);
?>