<?php
    require_once 'conexion.php';
    //Saber si se llama por post
if($_SERVER['REQUEST_METHOD']=='POST'){
    //Almacenar post en variables
    $nombre = $_POST['nombreusuario'];
    $apellido = $_POST['apellidousuario'];
    $cedula = $_POST['cedulausuario'];
    $telefono = $_POST['telefonousuario'];
    $direccion = $_POST['direccionusuario'];
    $correo = $_POST['correousuario'];

    $image = $_FILES['foto_usuario']['tmp_name'];
    $imgContent = addslashes(file_get_contents($foto));
    $check = getimagesize($_FILES[" foto_usuario"]["tmp_name"]);
    
        // validar si se envian todos los datos
        if(isset($_POST['nombreusu']) && isset($_POST['apellidousu']) && isset($_POST['cedulausu']) && isset($_POST['telefonousu'])
            && isset($_POST['direccionusu']) && isset($_POST['correousu'])&& isset($_POST['foto_usuario'])){
            // contruir la consulta
            $query = "INSERT INTO usuario (nombreusuario, apellidousuario, cedulausuario, telefonousuario,
            direccionusuario, correousuario, foto_usuario) VALUES(?, ?, ?, ?, ?, ?,?)";
            // Prepara la sentencia
            if($stmt = $conn->prepare($query)){
                // Envía lo datos haciendo un binding
                $stmt->bind_param('sssssss', $_POST['nombreusu'], $_POST['apellidousu'], $_POST['cedulausu'], $_POST['telefonousu'], 
                $_POST['direccionusu'], $_POST['correousu'], $_POST['foto_usuario']);
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
    require_once "agregar.html";
?>
