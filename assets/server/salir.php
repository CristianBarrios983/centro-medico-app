<?php
    session_start();

    //Destruye la sesion
    session_destroy();

    header("Location: ../../index.php");
    exit();
?>