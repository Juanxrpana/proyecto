<?php require_once './comunes/menu.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/bootstrap.css">
    <link rel="stylesheet" href="./CSS/inicio.css">
    <link rel="stylesheet" href="./CSS/consulta.css">
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="stylesheet" href="./CSS/login.css">

    <title>Usuarios</title>
</head>

<body>
    <div class="todo">
        <div class="main--content">

            <!-- Button trigger modal -->


            <!-- Modal -->
            <div class="modal fade" id="registroModal" data-bs-backdrop="false" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="registroModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content" style=" background: linear-gradient(to right, #962828, #6b3f3f); -webkit-box-shadow: -20px 20px 43px -21px rgba(0,0,0,0.51); -moz-box-shadow: -20px 20px 43px -21px rgba(0,0,0,0.51); box-shadow: -20px 20px 43px -21px rgba(0,0,0,0.51); color:aliceblue;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="registroModalLabel">Nuevo Usuario</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Aquí irá el formulario -->
                            <form method="POST" class="formulario" id="formulario">
                                <div class="form-group">
                                    <label for="nuevo_usuario">Cédula</label>
                                    <input type="text" class="form-control" id="nuevo_usuario" name="nuevo_usuario">
                                </div>
                                <div class="form-group">
                                    <label for="nombres">Nombres</label>
                                    <input type="text" class="form-control" id="nombres" name="nombres">
                                </div>
                                <div class="form-group">
                                    <label for="apellidos">apellidos</label>
                                    <input type="text" class="form-control" id="apellidos" name="apellidos">
                                </div>
                                <div class="form-group">
                                    <label for="clave">clave</label>
                                    <input type="password" class="form-control" id="clave" name="clave">
                                </div>
                                <div class="form-group">
                                    <label for="id_pregunta_s">Pregunta de Seguridad</label>
                                    <select class="form-control" id="id_pregunta_s" name="id_pregunta_s">
                                        <!-- Este select se llenará con JavaScript -->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="respuesta">Respuesta de Seguridad</label>
                                    <input type="text" class="form-control" id="respuesta" name="respuesta">
                                </div>
                                <button type="button" id="incluir" class="finalizacion" data-bs-dismiss="modal">Incluir</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="header--wrapper">
                <div class="header--titulo" id="hola">
                    <span>Registro y control</span>
                    <h2>Usuarios</h2>
                </div>

            </div>
            <div class="contenedor--tarjetas">
                <h3 class="main--titulo">
                    Registro Nuevo Usuario
                </h3>
                <button type="button" class="finalizacion" id="registrarse" data-bs-toggle="modal" data-bs-target="#registroModal"><span>Registrar</span></button>






                <br>
                <div class="usuario" id="usuario">
                    <span>Lista usuarios</span>
                    <div class="tablaDatosusuario" id="tablaDatosusuario"></div>
                </div>


            </div>

        </div>
    </div>
    <script src="./js/bootstrap.js"></script>
    <script src="./js/jquery-3.7.0.js"></script>
    <script src="./js/datatables.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/sweetalert2.js"></script>
    <script src="./js/formulario_registro_usuario.js"></script>

</body>

</html>