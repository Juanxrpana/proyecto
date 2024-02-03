<?php
ob_start();
    
    if (!is_file("../modelo/materia_prima.php")){

        echo "Falta definir la clase materia_prima";
        exit;
    }

    require_once ("../modelo/materia_prima.php");
    $obj= new Registromateria_prima();
    $datos=$obj->mostrarmateria_prima();

    $tablamateria_prima='<table class="table table-striped table-hover" id="tabla_materia_prima">
                     <thead>
                             <tr>
                                <th scope="col">Indentificación</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Quintales</th>
                                <th scope="col">Fecha de Compra</th>
                                <th scope="col">Estado</th>
                               
                            </tr>
                     </thead>
                     <tbody>';
    $datosTablamateria_prima="";
    foreach ($datos as $key => $value){
        $a = $value['idcompra'];
        $datosTablamateria_prima=$datosTablamateria_prima.'  
                            <tr style="cursor:pointer">
                                <td>'.$value['datos_prov_identificacion'].'</td>
                                <td>'.$value['nombre_prov'].'</td>
                                <td>'.$value['total_cantidad'].'</td>
                                <td>'.$value['fecha_compra'].'</td>
                                <td>'.$value['estado'].'</td>
                                
                                
                               
                                
                            </tr>';

    }
    echo $tablamateria_prima.$datosTablamateria_prima.'</tbody></table>';
?>
 
<?php
$html=ob_get_clean();
echo $html;
?>



