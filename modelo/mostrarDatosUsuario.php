<?php
if (!is_file("../modelo/usuario.php")) {
    echo "Falta definir la clase usuario";
    exit;
}

require_once("../modelo/usuario.php");
$obj = new Registrousuario();
$datos = $obj->mostrarusuario();

$tablausuario = '<table class="table table-striped table-hover" id="tablausuario">
                     <thead>
                             <tr id="tr">
                                <th scope="col">Usuario</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Apellido</th>
                                <th scope="col">Borrar</th>
                            </tr>
                     </thead>
                     <tbody>';
$datosTablausuario = "";
foreach ($datos as $key => $value) {
    $a = $value['idusuario'];
    $datosTablausuario .= '  
                            <tr style="cursor:pointer">
                                <td>' . $value['idusuario'] . '</td>
                                <td>' . $value['nombres'] . '</td>
                                <td>' . $value['apellidos'] . '</td>
                                <td>
                                <a class="btn btn-danger" id="eliminar" btn" data-id="' . $value['idusuario'] . '" onclick="borrar(' . $value['idusuario'] . ')"><span class="icon-trashcan"></span></a>
                                </td>
                            </tr>';
}

echo $tablausuario . $datosTablausuario . '</tbody></table>';
?>
