<?php
    require_once 'conexion.php';
    
    // consulta de datos
    $query = "SELECT idusuario, nombreusuario, apellidousuario, cedulausuario, correousuario FROM usuario";
    
    // ejecuto la consulta
    $result = $conn -> query($query);

    require_once "index.html";
?>

