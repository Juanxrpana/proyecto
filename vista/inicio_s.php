<html lang="en">

<head>

  <meta charset="utf-8">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./CSS/bootstrap.css">
  <link rel="stylesheet" href="./CSS/inicio.css">
  <link rel="stylesheet" href="./CSS/consulta.css">
  <link rel="stylesheet" href="./CSS/style.css">
  <link rel="stylesheet" href="./CSS/login.css">

  <title>Iniciar Sesión</title>


  <meta name="theme-color" content="#563d7c">


  <style>
    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>

  <!-- Custom styles for this template -->
  <link href="css/signin.css" rel="stylesheet">
</head>



<body class="text-center">
  <div class="container" style="max-width: 900px;
">
    <div class="row">
      <div class="col" style="margin: 49px;margin-top: 16%;">
        <img src="img/logo1.png" alt="logo" style="width: 225px;height: 200px;">

        <h1>
          <hr>TRADICION Y CALIDAD
        </h1>

      </div>
      <div class="col" style="padding-top: 6%;">

        <form class="form-signin" method="post" action="" id="f">
          <input type="text" name="accion_inicio_sesion" style="display:none">

          <h1 class="h3 mb-3 font-weight-normal">Acceso al sistema</h1>


          <div id="mensajes" style="display:none">
            <?php
            if (!empty($mensaje)) {
              echo $mensaje;
            }
            ?>
          </div>

          <div class="form-group row" style="margin-top: 150px;">
            <label for="usuario">Ingresar Cedula</label>
            <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Formato V-12345678" autofocus>
          </div>
          <div class="form-group row">
            <label for="contra" class="">Contraseña</label>
            <input type="password" id="contra" name="contra" class="form-control" placeholder="Contraseña" title="Solo letras y/o numeros y/o *- - entre 6 y 12 caracteres">
            <span></span>
          </div>
          <hr>
          <button class="finalizacion" id="iniciar"><span>Ingresar</span></button>
        </form>
        <button type="button" class="finalizacion" id="recordar" data-bs-toggle="modal" data-bs-target="#recordarModal"><span>Recuperar Contraseña</span></button>
        <br>

      </div>

      <!-- Modal de Recordar Contraseña -->
      <div class="modal fade" id="recordarModal" tabindex="-1" aria-labelledby="recordarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title recordar" id="recordarModalLabel">Recuperar Contraseña</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body recordar">
              <!-- Campo de entrada para la contraseña -->
              <div class="mb-3">
                <label for="recordar_cedula" class="form-label recordar">Ingrese sus datos</label>
                <input type="text" class="form-control" id="recordar_cedula" placeholder="Ingrese su cedula">
               
                <hr>
              
                <h6 style="color: #6c757d;">Pregunta de seguridad</h6>
                <input type="text" class="form-control" id="pregunta_show" placeholder="Su pregunta de seguridad" disabled>
                <hr>
              </div>
              <form method="POST" id="recuperador">
                
                
              </form>
            </div>
            <div class="modal-footer">
              <!-- Botón "Siguiente" -->
              <button id="v_usuario" class="btn btn-primary">Siguiente</button>
              <!-- Botón "Cerrar" -->
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>


      <!-- MODAL DE REGISTRO -->
      




      <!-- modal error -->
      <div class="container" style="display: contents" id="modal1">
        <div class="modal fade" id="mostrarmodal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">

                <div id="cabezerademodal">
                </div>
              </div>
              <div class="modal-body">
                <h4 style="color: black;">Usuario o contraseña incorrecta</h4>
                <div id="contenidodemodal">
                </div>
              </div>
              <div class="modal-footer">
                <a href="#" data-dismiss="modal" class="btn btn-primary">
                  <span class="glyphicon glyphicon-home"></span>
                  Cerrar</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>

</body>
<script src="./js/bootstrap.js"></script>
<script src="./js/jquery-3.7.0.js"></script>
<script src="./js/popper.min.js"></script>
<script src="./js/sweetalert2.js"></script>
<script src="./js/inicio_sesion.js"></script>
<!-- <script src="./js/formulario_registro_usuario.js"></script> -->


</html>