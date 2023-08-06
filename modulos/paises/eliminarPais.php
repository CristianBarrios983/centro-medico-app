<?php
    require('../../assets/server/conexion.php');

    session_start();

    // ID del usuario que deseamos eliminar
    $id_pais = $_GET['id'];

    // Consulta para eliminar al usuario y sus comentarios relacionados
    $query = "DELETE FROM paises WHERE id_pais = $id_pais";

    // Ejecutar la consulta
    if (mysqli_query($conn, $query)) {
        $_SESSION['mensaje'] = "Se ha eliminado satisfactoriamente";
        header("Location: listaPaises.php");
        exit();
    } else {
        $_SESSION['mensaje'] = "Error al eliminar";
        header("Location: listaPaises.php");
        exit();
    }

    // Cerrar la conexión
    mysqli_close($conn);
?>