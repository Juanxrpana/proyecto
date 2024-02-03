<?php
 //verifica que exista la vista de
 //la pagina
 session_start();
 if(is_file("vista/".$pagina.".php")){
 //si existe se la trae, ahora ve a la carpeta vista
 //y busca el archivo principal.php 
 require_once("vista/".$pagina.".php"); 

$username = $_POST['username'];
$password = $_POST['password'];

if ($datos === FALSE) {
    header('Location: ../vista/login.php');
}elseif($sentencia->rowCount() == 1){
     $_SESSION['nombre'] = $datos->username;
     // Define la página a la que debe redirigirse después del inicio de sesión
     echo "Cargando persona desde login";
     $_SESSION['persona'] = 'principal';
     header('Location: ../index.php');

 }


 }
 else{
 echo "pagina principal en construccion";
 }
?>