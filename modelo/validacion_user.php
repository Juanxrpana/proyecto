<?php

    
    if (!is_file("../modelo/inicio_s.php")){

        echo "Falta definir la clase inicio_s";
        exit;
    }

    require_once ("../modelo/inicio_s.php");
    $obj= new inicio();
    $datos=$obj->busca_cargo();

    echo "<input type='hidden' id='tipo-usuario' value='$datos'>";
 
?>

