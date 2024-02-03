<?php require_once './comunes/menu.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/inicio.css">
    <link rel="stylesheet" href="./CSS/bootstrap.css">
    <link rel="stylesheet" href="./CSS/cafe_tostado.css">
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="stylesheet" href="./CSS/datatables.min.css">
    <title>Café Final</title>
</head>

<body>
    <div class="main--content">
        <div class="header--wrapper">
            <div class="header--titulo">
            <span>Registro y control</span>    
            <h2>Café Final</h2>
            </div>
            <div class="contador_texto" id="contador_texto"><h6>Café tostado: </h6><div id="contador_cafe_tostado" class="contador_cafe_tostado"></div><h6>/5</h6></div>
            <div class="contador_texto" id="contador_texto"><h6>Materia prima: </h6><div id="contador_materia_prima" class="contador_materia_prima"></div><h6>/2000</h6></div>
            <div class="contador_texto" id="contador_texto"><h6>Café Final: </h6><div id="contador_cafe_final" class="contador_cafe_final"></div><h6>/3000</h6></div>

        </div>
        
        <div class="contenedor--tarjetas">
            <h3 class="main--titulo">
                Registro de café molido para empaquetar
            </h3>
            <h3>Tabla café tostado</h3>
            <form class="formulario" action="POST" method="POST">
            <input type="text" name="accion" id="accion" style="display:none" />
                <div id="tablaDatoscafe_tostado_final"></div>
        </form>
        <h3>Tabla bultos para venta</h3>
            <div id="tablaDatoscafe_final"></div>

        </div>

     </div>

    <script src="./js/bootstrap.bundle.js"></script>
    <script src="./js/jquery-3.7.1.min.js"></script>
    <script src="./js/datatables.js"></script>
    <script src="./js/formulario_registro_cafe_final.js"></script>
    <script src="./js/sweetalert2.js"></script>
</body>

</html>