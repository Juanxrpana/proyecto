<?php require_once './comunes/menu.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/inicio.css">
    <link rel="stylesheet" href="CSS/bootstrap.css">
    <link rel="stylesheet" href="CSS/formularios_registro_materia_prima.css">
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="stylesheet" href="./CSS/modal.css">
    <link href="./CSS/datatables.min.css" rel="stylesheet">
    <!--     <script src="https://kit.fontawesome.com/ecd5745f4f.js" crossorigin="anonymous"></script>
 -->
    <title>Materia prima</title>
</head>

<body style="background-color:#ebe9e9;">
    <div class="main--content">
        <div class="header--wrapper">
           
            <div class="header--titulo" id="hola">
                <span>Registro y control</span>
                <h2>Materia Prima</h2>
            </div>

            <div class="contador_texto">
                <h6>Contador de materia prima: </h6>
                <div id="contador_materia_prima" class="contador_materia_prima"></div>
                <h6>/2000</h6>
            </div>

        </div>
        <div class="contenedor--tarjetas">
            <h3 class="main--titulo">
                Registro de Materia Prima
            </h3>
            <div class="container">

                <form method="POST" class="formulario" id="formulario">
                    <input type="text" name="accion" id="accion" style="display:none" />


                    <!-- Grupo: sd -->

                    <div class="Proveedor">
                        <h3>Proveedor</h3>
                        <div class="proveedor2">

                            <select name="proveedor" id="proveedor">
                                <option value="" selected>Proveedor</option>
                            </select>
                            <div><a href="?pagina=proveedor" type="button" id="nuevo_proveedor" class="btn btn-success">Proveedor<h4 class="icon-user-plus"></h4></a>
                                <!-- Botón para abrir el modal -->
                                <button id="openModalBtn" class="btn btn-success">Lista proveedores<h4 class="icon-search"></h4></button>

                                <!-- El modal -->
                                <div id="myModal" class="modal">
                                    <div class="modal-content">
                                        <span class="close">&times;</span>
                                        <h2>Lista de proveedores</h2>
                                        <div class="tablaDatosProveedor" id="tablaDatosProveedor"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <h3>Fecha de recepción</h3>
                        <div class="col-6">

                            <input type="date" class="datepicker_input form-control" id="fecha" placeholder="" required="">
                        </div>
                    </div>


                    <div class="row">
                        <div class="form col-sm-5 ">
                            <label for="Calidad A" class="title form-label">Calidad A</label>
                            <input type="text" class="cafe-input" id="cantidad1" placeholder="">
                        </div>

                        <input type="text" class="form-control" id="calidad1" value="1" style="display:none">
                        <input type="text" class="form-control" id="calidad2" value="2" style="display:none">
                        <div class="calidad col-sm-2 "></div>
                        <div class="form col-sm-5">
                            <label for="Calidad B" class="title form-label">Calidad B</label>
                            <input type="text" class="cafe-input" id="cantidad2" placeholder="">
                        </div>
                        <!-- Grupo: Cantidad -->









                        <div class="formulario__grupo formulario__grupo-btn-enviar">
                            <button type="button" class="btn btn-dark" id="incluir" name="incluir">INCLUIR</button>

                        </div>
                </form>
            </div>

            <div class="materia_prima" id="materia_prima">

                <span>Materia Prima</span>
                <div class="tablaDatosmateria_prima" id="tablaDatosmateria_prima"></div>
            </div>

            <button type="button" class="btn btn-danger" id="imprimir" name="imprimir">IMPRIMIR</button>







        </div>

        <script src="./js/jquery-3.7.1.min.js"></script>
        <script src="./js/datatables.min.js"></script>
        <script src="./js/bootstrap.bundle.js"></script>
        <script src="./js/formulario_registro_materia_prima.js"></script>
        <script src="./js/modal.js"></script>
        <script src="./js/sweetalert2.js"></script>
</body>

</html>