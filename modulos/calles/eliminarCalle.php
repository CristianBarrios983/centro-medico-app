<?php
    require('../../assets/server/conexion.php');

    session_start();

    // ID del usuario que deseamos eliminar
    $id_calle = $_GET['id'];

    // Consulta para eliminar al usuario y sus comentarios relacionados
    $query = "DELETE FROM calles WHERE id_calle = $id_calle";

    // Ejecutar la consulta
    if (mysqli_query($conn, $query)) {
        $_SESSION['mensaje'] = "Se ha eliminado satisfactoriamente";
        header("Location: listaCalles.php");
        exit();
    } else {
        $_SESSION['mensaje'] = "Error al eliminar";
        header("Location: listaCalles.php");
        exit();
    }

    // Cerrar la conexión
    mysqli_close($conn);
?>