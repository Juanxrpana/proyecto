<?php require_once './comunes/menu.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/inicio.css">
    <link rel="stylesheet" href="./CSS/bootstrap.css">
    <link rel="stylesheet" href="./CSS/style.css">

    <title>INICIO</title>
</head>

<body>

    
    <div class="main--content">
        <div class="header--wrapper">
            <div class="header--titulo">
                <span>inicio</span>
                <h2>Controles</h2>
            </div>

        </div>
        <div class="contenedor--tarjetas">
            <h3 class="main--titulo">
                DATA
            </h3>
            <div class="tarjetas--wrapper">
                <!-- aqui empiezan las tarjetas -->
                <div class="tarjetas tarjetas--materia_prima">
                    <div class="tarjetas--cabezera">
                        <div class="ammount">
                            <span class="titulo">
                                <h3>MATERIA PRIMA</h3>
                            </span>
                            <div class="contador_texto" id="contador_texto">
                                <div id="contador_materia_prima" class="contador_materia_prima"></div>
                                <h6>/2000</h6>
                            </div>
                            <!-- <i><a href="?pagina=consulta">VER ULTIMO REGISTRO</a></i> -->
                            </span>
                        </div>
                    </div>
                </div>
               
                
                <div class="tarjetas tarjetas--inventario">
                    <div class="tarjetas--cabezera">
                        <div class="ammount">
                            <span class="titulo">
                                <h3>CAFÉ TOSTADO</h3>
                            </span>
                            <div class="contador_texto_t" id="contador_texto_cafe_t">
                                <div id="contador_cafe_tostado" class="contador_cafe_tostado"></div>
                                <h6>/5</h6>
                            </div>

                        </div>
                    </div>
                </div>
                
                <div class="tarjetas tarjetas--compras">
                    <div class="tarjetas--cabezera">
                        <div class="ammount">
                            <span class="titulo">
                                <h3>CAFÉ FINAL (BULTO)</h3>
                            </span>
                            <div class="contador_texto_f" id="contador_texto">
                                <div id="contador_cafe_final" class="contador_cafe_final"></div>
                                <h6>/3000</h6>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>
</body>
<script src="./js/bootstrap.bundle.js"></script>
<script src="./js/jquery-3.7.1.min.js"></script>
<script src="./js/inicio.js"></script>
<script src="./js/formulario_registro_materia_prima.js"></script>
<script src="./js/formulario_registro_cafe_tostado.js"></script>
<script src="./js/formulario_registro_cafe_final.js"></script>
<script src="./js/sweetalert2.js"></script>

</html>