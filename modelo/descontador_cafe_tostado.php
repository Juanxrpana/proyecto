<?php

    
    if (!is_file("../modelo/cafe_tostado.php")){

        echo "Falta definir la clase cafe_tostado";
        exit;
    }

    require_once ("../modelo/cafe_tostado.php");
    $obj= new Registrocafe_tostado();
    $obj->inactivadorcafe_tostado();
    $obj->descontador_total_cafe_tostado();
   /*  $obj->contadorcafe_tostado(); */
   
    


    $contador_cafe_tostado= $datos;
    echo "contador de cafe tostado: ".$contador_cafe_tostado;
 
?>

