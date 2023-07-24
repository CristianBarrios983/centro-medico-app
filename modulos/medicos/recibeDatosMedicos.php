<?php
    session_start();
    require("../../assets/server/conexion.php");

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $tipoDocumento = $_POST['tipo_doc'];
    $numeroDocumento = $_POST['num_doc'];
    $cuil = $_POST['cuil'];
    $numSegSocial = $_POST['num_seg_social'];
    $telefono = $_POST['num_tel'];
    $email = $_POST['email'];
    $sex = $_POST['sex'];
    $pass = $_POST['pass'];
    $matricula = $_POST['matricula'];
    $residencia = $_POST['residencia'];
    $rol = $_POST['rol'];
    $especialidad = $_POST['especialidad'];

    $queryCheckEmail = "SELECT * FROM usuarios WHERE email = '$email'";
    $resultCheckEmail = mysqli_query($conn, $queryCheckEmail);

    if(mysqli_num_rows($resultCheckEmail) > 0){
        //El email ya existe en la base de datos, se muestra el mensaje de error
        $_SESSION['mensaje'] = "El email ingresado ya está en uso";
        header("Location: registroMedico.php");
        exit();
    }else{
        //Si el email no se encuentra en la base de datos, se procede con el registro
        $hash = password_hash($pass, PASSWORD_DEFAULT);

        $query = "INSERT INTO documentaciones(tipo_documento,numero_documento,cuil,nro_seg_social) VALUES ('$tipoDocumento','$numeroDocumento','$cuil','$numSegSocial')";

        if(mysqli_query($conn,$query)){
            $id_documentacion = mysqli_insert_id($conn); // Obtenemos el ID del documento registrado

            $query="INSERT INTO personas(nombre,apellido,sexo,id_documento) VALUES ('$name','$surname','$sex',$id_documentacion)";
        
            if(mysqli_query($conn, $query)){
                $id_persona = $conn->insert_id; //Se obtiene el id del ultimo registro de persona

                $sql = "INSERT INTO medicos(id_persona,matricula_medico) VALUES ($id_persona,'$matricula')";

                if(mysqli_query($conn, $sql)){
                    $id_medico = $conn->insert_id;

                    $query = "INSERT INTO direcciones(residencia) VALUES ('$residencia')";

                    if(mysqli_query($conn, $query)){

                        $id_direccion = $conn->insert_id;
                    
                        $query = "INSERT INTO datos_contactos(telefono,id_direccion,id_persona) VALUES ($telefono,$id_direccion,$id_persona)";
    
                        if(mysqli_query($conn, $query)){
                
                            $sql = "INSERT INTO espxmedicos(id_especialidad,id_medico) VALUES ($especialidad,$id_medico)";

                            if(mysqli_query($conn,$sql)){

                                $query="INSERT INTO usuarios(id_rol,email,pass,id_persona) VALUES ($rol,'$email','$hash',$id_persona)";
            
                                if (mysqli_query($conn,$query)) {
                                    $_SESSION['mensaje'] = "Registrado exitosamente";
                                    header("Location: listaMedicos.php");
                                    exit();
                                }else{
                                    $_SESSION['mensaje'] = "No se pudo registrar";
                                    header("Location: registroMedico.php");
                                    exit();
                                    //echo 'Se produjo un error'. mysqli_error();
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    mysqli_close($conn);

?>