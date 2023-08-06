<?php
    require('../../assets/server/conexion.php');

    session_start();

    // ID del usuario que deseamos eliminar
    $id_localidad = $_GET['id'];

    // Consulta para eliminar al usuario y sus comentarios relacionados
    $query = "DELETE FROM localidades WHERE id_localidad = $id_localidad";

    // Ejecutar la consulta
    if (mysqli_query($conn, $query)) {
        $_SESSION['mensaje'] = "Se ha eliminado satisfactoriamente";
        header("Location: listaLocalidades.php");
        exit();
    } else {
        $_SESSION['mensaje'] = "Error al eliminar";
        header("Location: listaLocalidades.php");
        exit();
    }

    // Cerrar la conexión
    mysqli_close($conn);
?>