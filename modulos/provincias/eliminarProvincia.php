<?php
    require('../../assets/server/conexion.php');

    session_start();

    // ID del usuario que deseamos eliminar
    $id_provincia = $_GET['id'];

    // Consulta para eliminar al usuario y sus comentarios relacionados
    $query = "DELETE FROM provincias WHERE id_provincia = $id_provincia";

    // Ejecutar la consulta
    if (mysqli_query($conn, $query)) {
        $_SESSION['mensaje'] = "Se ha eliminado satisfactoriamente";
        header("Location: listaProvincias.php");
        exit();
    } else {
        $_SESSION['mensaje'] = "Error al eliminar";
        header("Location: listaProvincias.php");
        exit();
    }

    // Cerrar la conexión
    mysqli_close($conn);
?>