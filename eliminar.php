<?php
    require_once 'conexion.php';

    // Tomar los datos editados y actualiar en la base
    if(isset($_GET['id']) && !empty(trim($_GET['id']))){
        // contruir la consulta
        $query = "DELETE FROM usuario WHERE idusuario=?";
        // Prepara la sentencia
        if($stmt = $conn->prepare($query)){
            // Envía lo datos haciendo un binding
            $stmt->bind_param('i', $_GET['id']);
            if($stmt -> execute()){
                header("location: index.php");
                exit();
            }else{
                echo "Error! Por favor intente más tarde";
            }
            // cerrar la setencia o stmt
        $stmt -> close();
        }
    $conn -> close();
    }
?>