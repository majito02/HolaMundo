<?php
//DATOS PARA LA CONEXIÓN HACIA LA BDD
define('SERVERNAME', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DBNAME', 'ejemplo');


//creacion de la conexion a la bdd mysqli
$conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);
//CONTROLAR LA CONEXIÓN DE LA BDD
if($conn -> connect_error){
    die('Conexión fallida'. $conn -> connect_error);

}else{
    /*echo('conexion exitosa');*/
}

?>

