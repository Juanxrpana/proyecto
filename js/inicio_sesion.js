$(document).ready(function() {



    $(document).on("click", "#respuesta_boton", function() {
        console.log("validar respuesta de usuario ahhhhhhhh");
        var datos = new FormData();
        datos.append('accion', 'respuesta');
        datos.append('id_usuario', $("#recordar_cedula").val());
        datos.append('respuesta', $("#respuesta").val());
        respuestaAjax(datos, 'respuesta');
        console.log(datos.get('accion') + " = accion");

    });

    $(document).on("click", "#actualizar_clave", function() {
        console.log("validar q las dos contraseñas sean iguales");
        var clave1 = $("#nueva_clave").val();
        var clave2 = $("#nueva_clave2").val();
        if (clave1 == clave2 && clave1 !== "" && clave2 !== "") {
            var datos = new FormData();
            datos.append('accion', 'actualizar');
            datos.append('id_usuario', $("#recordar_cedula").val());
            datos.append('nueva_clave', $("#nueva_clave").val());
            actualizarAjax(datos, 'actualizar');
            console.log(datos.get('accion') + " = accion");
            console.log(clave1);
            console.log(clave2);

        } else {
            swal.fire({
                title: 'Error',
                text: "Las contraseñas no coinciden",
                icon: 'error',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar'
            })
        }


    });




    //Seccion para mostrar lo enviado en el modal mensaje//

    //Función que verifica que exista algo dentro de un div
    //oculto y lo muestra por el modal
    if ($.trim($("#mensajes").text()) != "") {
        mensajemodal($("#mensajes").html());
    }


    $("#iniciar").on("click", function() {
        if (validarboton()) {
            $("#accion_inicio_sesion").val("usuario");
            $("#f").submit();
        }
    });
    $("#usuario").on("keypress", function(e) {
        validarkeypress(/^[A-Z0-9-\b]*$/, e);
    });
    $("#usuario").on("keyup", function() {
        validarkeyup(/^[VE]{1}[-]{1}[0-9]{6,8}$/, $(this),
            $("#pCiRepre"), "El formato debe ser V-10123123 ");
    });

    $("#contra").on("keypress", function(e) {
        validarkeypress(/^[0-9a-zA-Z*\b-]*$/, e);
    });
    $("#contra").on("keyup", function() {
        validarkeyup(/^[0-9a-zA-Z*\b-]{4,10}$/, $(this), $("#sclave"), "De 4 a 10 caracteres");
    });

    $("#v_usuario").on("click", function() {
        console.log("validar pregunta deusuario");
        var datos = new FormData();
        datos.append('accion', 'pregunta');
        datos.append('id_usuario', $("#recordar_cedula").val());
        recuperaAjax(datos, 'pregunta');

        console.log(datos.get('accion') + " esta es la accion");
    });




    /* $("#incluir").on("click", function() {
        var datos = new FormData();
        datos.append('accion', 'incluir');
        datos.append('nuevo_usuario', $("#nuevo_usuario").val());
        datos.append('clave', $("#clave").val());
        datos.append('nombres', $("#nombres").val());
        datos.append('apellidos', $("#apellidos").val());
        datos.append('id_pregunta_s', $("#preguntaSeguridad").val());
        datos.append('respuesta', $("#respuestaSeguridad").val());
        enviaAjax(datos, 'incluir');
    });

    $("#registrarse").on("click", function() {
        llenarLista();
    }) */
});

function recuperador() {
    var input = '<div' + ' ' + 'class="form-group">' +
        '<label ' + 'for="respuesta" style=" color: #6c757d" >Respuesta de Seguridad</label>' +
        '<input type="text" class="form-control" id="respuesta" name="respuesta">' +
        '<button type=button id="respuesta_boton" class="btn btn-success">Siguiente</button>'
    '</div>';
    $("#recuperador").append(input);
    eliminarsiguiente();
    $("#recordar_cedula").prop("disabled", true);
}

function nueva_clave() {
    var input = '<div' + ' ' + 'class="form-group">' +
        '<label ' + 'for="respuesta" style=" color: #6c757d" >Ingresa la nueva contraseña</label>' +
        '<input type="password" class="form-control" id="nueva_clave" name="nueva_clave">' +
        '<label ' + 'for="respuesta" style=" color: #6c757d" >Ingresa nuevamente la contraseña</label>' +
        '<input type="password" class="form-control" id="nueva_clave2" name="nueva_clave2">' +
        '<br>' +
        '<button type=button id="actualizar_clave" class="btn btn-success">Guardar</button>'
    '</div>';
    $("#recuperador").append(input);
    document.getElementById('respuesta_boton').style.display = 'none';
    $("#respuesta").prop("disabled", true);
}

function eliminarsiguiente() {
    document.getElementById('v_usuario').style.display = 'none';
}

function recuperaAjax(datos, accion) {
    $.ajax({
        async: true,
        url: '', //la pagina a donde se envia por estar en mvc, se omite la ruta ya que siempre estaremos en la misma pagina
        type: 'POST', //tipo de envio 
        contentType: false,
        data: datos,
        processData: false,
        cache: false,
        success: function(resultado) {

            if (resultado == "undefined") {
                console.log("salio mal");
                Swal.fire({
                    title: 'Error',
                    text: 'Hubo un problema en la busqueda',
                    icon: 'error'
                })
            } else {
                console.log("saliobien");
                var data = JSON.parse(resultado);
                document.getElementById('pregunta_show').value = data.pregunta_seguridad;

                recuperador();
            };



            //si resulto exitosa la transmision
        },
        error: function() {

            Swal.fire({
                title: 'Error',
                text: 'Hubo un problema en la busqueda',
                icon: 'error',
                timer: 4000, // Establece el tiempo en milisegundos (5 segundos en este caso)
                showConfirmButton: false // Oculta el botón "Aceptar"
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {
                    // Esto se ejecutará después de que se cierre el mensaje automáticamente
                    console.log('Mensaje modal de error cerrado');
                }
            });


        }

    });


}

function respuestaAjax(datos, accion) {
    $.ajax({
        async: true,
        url: '', //la pagina a donde se envia por estar en mvc, se omite la ruta ya que siempre estaremos en la misma pagina
        type: 'POST', //tipo de envio 
        contentType: false,
        data: datos,
        processData: false,
        cache: false,
        success: function(resultado) {
            console.log("manda a decir el sql que: " + resultado);

            if (resultado == "invalida") {
                Swal.fire({
                    title: "Verifica tu respuesta",
                    text: "Pregunta de seguridad invalida",
                    icon: "warning"
                });
            } else {
                nueva_clave();
            }


            //si resulto exitosa la transmision
        },
        error: function() {

            Swal.fire({
                title: 'Error',
                text: 'Hubo un problema en la busqueda',
                icon: 'error',
                timer: 4000, // Establece el tiempo en milisegundos (5 segundos en este caso)
                showConfirmButton: false // Oculta el botón "Aceptar"
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {
                    // Esto se ejecutará después de que se cierre el mensaje automáticamente
                    console.log('Mensaje modal de error cerrado');
                }
            });


        }

    });


};

function actualizarAjax(datos, accion) {
    $.ajax({
        async: true,
        url: '', //la pagina a donde se envia por estar en mvc, se omite la ruta ya que siempre estaremos en la misma pagina
        type: 'POST', //tipo de envio 
        contentType: false,
        data: datos,
        processData: false,
        cache: false,
        success: function(resultado) {
            console.log("manda a decir el sql que: " + resultado);

            swal.fire({
                title: "Actualizado",
                text: "Tu contraseña se actualizo correctamente",
                icon: "success"
            });
        },
        error: function() {

            Swal.fire({
                title: 'Error',
                text: 'Hubo un problema en la busqueda',
                icon: 'error',
                timer: 4000, // Establece el tiempo en milisegundos (5 segundos en este caso)
                showConfirmButton: false // Oculta el botón "Aceptar"
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {
                    // Esto se ejecutará después de que se cierre el mensaje automáticamente
                    console.log('Mensaje modal de error cerrado');
                }
            });


        }

    });


}




//console.log("aisdioj");


function mensajemodal(mensaje) {

    $("#contenidodemodal").html(mensaje);
    $("#mostrarmodal").modal("show");
    setTimeout(function() {
        $("#mostrarmodal").modal("hide");
    }, 4000);
}

function validarboton() {
    return true;
}

//Función para validar por Keypress
function validarkeypress(er, e) {

    key = e.keyCode;


    tecla = String.fromCharCode(key);


    a = er.test(tecla);

    if (!a) {

        e.preventDefault();
    }


}
//Función para validar por keyup
function validarkeyup(er, etiqueta, etiquetamensaje,
    mensaje) {
    a = er.test(etiqueta.val());
    if (a) {
        etiquetamensaje.text("");
        //console.log("A1");
        return 1;
    } else {
        etiquetamensaje.text(mensaje);
        return 0;
    }
}