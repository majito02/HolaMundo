<?php
    require_once 'conexion.php';

    // Validar si se envian los datos por el método get
    if(isset($_GET['id']) && !empty(trim($_GET['id']))){
        // contruir la consulta
        $query = 'SELECT * FROM usuario WHERE idusuario = ?';
        // preparar la sentencia
        if($stmt = $conn -> prepare($query)){
            $stmt -> bind_param('i', $_GET['id']);
            // ejecuto la sentencia
            if($stmt -> execute()){ 
                $result = $stmt -> get_result();
                if($result -> num_rows == 1){
                    $row = $result -> fetch_array(MYSQLI_ASSOC);
                    $nombre = $row['nombreusuario'];
                    $apellido = $row['apellidousuario'];
                    $cedula = $row['cedulausuario'];
                    $telefono = $row['telefonousuario'];
                    $direccion = $row['direccionusuario'];
                    $correo = $row['correousuario'];
                    $foto = $row ['foto_usuario'];
                }else{
                    echo 'Error, No existen los datos';
                    exit();
                }
            }else{
                echo 'Error! Revise la conexión con al base de datos';
                exit();
            }
        }
        $stmt -> close();
        $result -> close();
    }else{
        echo 'Error! Intente más tarde';
        exit();
    }
    require_once "leer.html";
    ?>