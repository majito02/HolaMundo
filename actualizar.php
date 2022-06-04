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
    }else{
        header("location: index.php");
        exit();
    }

      //SEGUNDA PARTE
      //TOMAR LOS DATOS EDITADOS Y ACTUALIZAR EN LA BASE 
      // cotrolar si se enviaron datos por el POST
      if($_SERVER['REQUEST_METHOD']=='POST'){
        // validar si se envian todos los datos
        if(isset($_POST['nombreusu']) && isset($_POST['apellidousu']) && isset($_POST['cedulausu']) && isset($_POST['telefonousu'])
            && isset($_POST['direccionusu']) && isset($_POST['correousu'])){
            // contruir la consulta
            $query = "UPDATE usuario SET nombreusuario=?, apellidousuario=?, cedulausuario=?, telefonousuario=?,
            direccionusuario=?, correousuario=? WHERE idusuario=?";
            // Prepara la sentencia
            if($stmt = $conn->prepare($query)){
                // Envía lo datos haciendo un binding
                $stmt->bind_param('ssssssi', $_POST['nombreusu'], $_POST['apellidousu'], $_POST['cedulausu'], $_POST['telefonousu'], 
                $_POST['direccionusu'], $_POST['correousu'], $_GET['id']);
                if($stmt -> execute()){
                    header("location: index.php");
                    exit();
                }else{
                    echo "Error! Por favor intente más tarde";
                }
                // cerrar la setencia o stmt
                $stmt -> close();
            }else{
                echo 'Error query prepare';
            }
        }else{
            echo 'Error post';
        }
    $conn -> close();
    }

require_once "actualizar.html";
?>


