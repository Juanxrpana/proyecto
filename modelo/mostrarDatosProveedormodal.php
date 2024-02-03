<?php
if (!is_file("../modelo/proveedor.php")) {
    echo "Falta definir la clase proveedor";
    exit;
}

require_once("../modelo/proveedor.php");
$obj = new Registroproveedor();
$datos = $obj->mostrarproveedor();

$tablaproveedor = '<table class="table table-striped table-hover" id="tablaproveedor">
                     <thead>
                             <tr id="tr">
                                <th scope="col">ID</th>
                                <th scope="col">Identificación</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Ubicación</th>
                                <th scope="col">Finca</th>
                                
                            </tr>
                     </thead>
                     <tbody>';
$datosTablaproveedor = "";
foreach ($datos as $key => $value) {
    $a = $value['id_prov'];
    $datosTablaproveedor .= '  
                            <tr style="cursor:pointer">
                                <td>' . $value['id_prov'] . '</td>
                                <td>' . $value['identificacion'] . '</td>
                                <td>' . $value['nombre_prov'] . '</td>
                                <td>' . $value['ubicacion'] . '</td>
                                <td>' . $value['nombre_finca'] . '</td>
                               
                            </tr>';
}

echo $tablaproveedor . $datosTablaproveedor . '</tbody></table>';
?>
