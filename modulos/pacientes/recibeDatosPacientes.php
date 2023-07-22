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
    $sex = $_POST['sex'];
    $info_medica = $_POST['info_medica'];
    $residencia = $_POST['residencia'];


        $query = "INSERT INTO documentaciones(tipo_documento,numero_documento,cuil,nro_seg_social) VALUES ('$tipoDocumento','$numeroDocumento','$cuil','$numSegSocial')";

        if(mysqli_query($conn,$query)){
            $id_documentacion = mysqli_insert_id($conn); // Obtenemos el ID del documento registrado

            $query="INSERT INTO personas(nombre,apellido,sexo,id_documento) VALUES ('$name','$surname','$sex',$id_documentacion)";
        
            if(mysqli_query($conn, $query)){
                $id_persona = $conn->insert_id; //Se obtiene el id del ultimo registro de persona

                $sql = "INSERT INTO pacientes(id_persona,informacion_medica) VALUES ($id_persona,'$info_medica')";

                if(mysqli_query($conn, $sql)){

                    $query = "INSERT INTO direcciones(residencia) VALUES ('$residencia')";

                    if(mysqli_query($conn, $query)){

                        $id_direccion = $conn->insert_id;
                    
                        $query = "INSERT INTO datos_contactos(telefono,id_direccion,id_persona) VALUES ($telefono,$id_direccion,$id_persona)";
    
                        if(mysqli_query($conn, $query)){
                            $_SESSION['mensaje'] = "Registrado exitosamente";
                            header("Location: listaPacientes.php");
                            exit();
                        }else{
                            $_SESSION['mensaje'] = "No se pudo registrar";
                            header("Location: registroPaciente.php");
                            exit();
                            //echo 'Se produjo un error'. mysqli_error();
                        }
                        }
                    }
                }
            }

    mysqli_close($conn);

?>