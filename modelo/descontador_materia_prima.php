<?php

    
    if (!is_file("../modelo/materia_prima.php")){

        echo "Falta definir la clase materia_prima";
        exit;
    }

    require_once ("../modelo/materia_prima.php");
    $obj= new Registromateria_prima();
    $obj->inactivadormateria_prima();
    $obj->descontador_total_materia_prima(); 
   
    

    /* $datos=$obj->mostrar_contador(); */


    $contador_materia_prima= $datos;
    echo "contador de materia prima: ".$contador_materia_prima;
 
?>