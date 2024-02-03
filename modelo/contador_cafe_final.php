<?php

    
    if (!is_file("../modelo/cafe_final.php")){

        echo "Falta definir la clase cafe_final";
        exit;
    }

    require_once ("../modelo/cafe_final.php");
    $obj= new Registrocafe_final();
    $obj->contadorcafe_final();
    $datos=$obj->mostrar_contador_cafe_final();



   
    echo $datos;
 
?>

