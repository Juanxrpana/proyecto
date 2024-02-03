<?php

    
    if (!is_file("../modelo/cafe_tostado.php")){

        echo "Falta definir la clase cafe_tostado";
        exit;
    }

    require_once ("../modelo/cafe_tostado.php");
    $obj= new Registrocafe_tostado();
    $obj->contadorcafe_tostado();
    $datos=$obj->mostrar_contador_cafe_tostado();



   
    echo $datos;
 
?>

