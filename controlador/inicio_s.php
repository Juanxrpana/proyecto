<?php

//verifica que exista la vista de
//la pagina

if (!is_file("modelo/" . $pagina . ".php")) {
  //alli pregunte que si no es archivo se niega //con !
  //si no existe envio mensaje y me salgo
  echo "Falta definir la clase " . $pagina;
  exit;
}
require_once("modelo/" . $pagina . ".php");


if (is_file("vista/" . $pagina . ".php")) {
  $o = new inicio();
  if (!empty($_POST)) {

    $accion = $_POST['accion'];


    if ($accion == 'pregunta') {
      $o->set_usuario($_POST['id_usuario']);
      $resultado = $o->validarusuario_pregunta();
      echo json_encode($resultado);
      exit;
    } elseif ($accion == 'respuesta') {
      $o->set_usuario($_POST['id_usuario']);
      $o->set_respuesta($_POST['respuesta']);
      $resultado = $o->validarrespuesta();
      echo $resultado;
      exit;
    } 
    elseif ($accion == 'actualizar') {
      $o->set_usuario($_POST['id_usuario']);
      $o->set_clave($_POST['nueva_clave']);
      $nueva_clave = $_POST['nueva_clave'];
      $resultado = $o->actualizarclave($nueva_clave);
      echo $resultado;
      exit;
    } else {

      $o->set_usuario($_POST['usuario']);
      $o->set_clave($_POST['contra']);

      $resultado_busqueda = $o->busca();
      if ($resultado_busqueda == "¡Error en los datos ingresados!") {
        $mensaje = "Usuario o clave inválida";
      } else {
        session_start();
        $_SESSION['id_usuario'] = $_POST['usuario'];

        // Obtiene el cargo del usuario
        $cargo_usuario = $o->busca_cargo();
        if ($cargo_usuario == "1" ||  $cargo_usuario == "2") {
          $_SESSION['nivel'] = $cargo_usuario;
          echo $_SESSION['id_usuario'];
          echo  $_SESSION['nivel'];
          header("Location: .?pagina=inicio");
          exit;
        } else {
          $mensaje = "Faltan permisos";
        }
      }
    }
  }

  require_once("vista/" . $pagina . ".php");
} else {
  echo "pagina en construccion";
}
