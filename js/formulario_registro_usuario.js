$(document).ready(function() {

    mostrarDatosusuario();




    $("#incluir").on("click", function() {
        var datos = new FormData();
        datos.append('accion', 'incluir');
        datos.append('nuevo_usuario', $("#nuevo_usuario").val());
        datos.append('clave', $("#clave").val());
        datos.append('nombres', $("#nombres").val());
        datos.append('apellidos', $("#apellidos").val());
        datos.append('id_pregunta_s', $("#id_pregunta_s").val());
        datos.append('respuesta', $("#respuesta").val());
        if (validarselect()) {
            enviaAjax(datos, 'incluir');
        } else {
            Swal.fire({
                title: 'Error',
                text: "No se llenaron todos los datos",
                icon: 'error',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar'
            })
        }
    });

    $("#registrarse").on("click", function() {
        llenarLista();
    })

    /* $("#v_usuario").on("click", function() {
        var datos = new FormData();
        datos.append('accion', 'validarusuario');
        datos.append('id_usuario', $("#recordar_cedula").val());
        enviaAjax3(datos, 'validarusuario');
    }) */




});

function enviaAjax(datos, accion) {
    $.ajax({
        async: true,
        url: '', //la pagina a donde se envia por estar en mvc, se omite la ruta ya que siempre estaremos en la misma pagina
        type: 'POST', //tipo de envio 
        contentType: false,
        data: datos,
        processData: false,
        cache: false,
        success: function(respuesta) {
            console.log(respuesta);
            //si resulto exitosa la transmision
            if (accion == "consultar") {
                $("#id_pregunta_s").html(respuesta);
            } else {
                mostrarDatosusuario();
                Swal.fire({
                    title: 'Usuario registrado exitosamente',
                    text: "",
                    icon: 'success',
                    timer: 4000, // Establece el tiempo en milisegundos (5 segundos en este caso)

                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        // Esto se ejecutará después de que se cierre el mensaje automáticamente
                        console.log('Mensaje modal cerrado');
                    }
                });

            }
        },
        error: function() {

            Swal.fire({
                title: 'Error al ingresar la materia primar',
                text: 'Hubo un problema al registrar la materia primar.',
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

function enviaAjax3(datos, accion) {
    $.ajax({
        async: true,
        url: '', //la pagina a donde se envia por estar en mvc, se omite la ruta ya que siempre estaremos en la misma pagina
        type: 'POST', //tipo de envio 
        contentType: false,
        data: datos,
        processData: false,
        cache: false,
        success: function(respuesta) {
            console.log(respuesta);
            // 'resultado' es la variable que contiene el resultado de la validación de usuario
            if (respuesta) {
                // Muestra la pregunta en algún elemento del DOM (por ejemplo, un div con el id 'preguntaSeguridad')
                $("#pregunta").text("Pregunta de seguridad: " + respuesta.id_pregunta_s);
                // También puedes almacenar el ID de la pregunta en una variable global si es necesario para futuras operaciones
                idPreguntaSeguridad = respuesta.id_pregunta_s;
            } else {
                // Maneja el caso en el que el usuario no existe
                console.log("Usuario no encontrado");
            }



        },
        error: function() {

            Swal.fire({
                title: 'Error al ingresar solicitar la pregunta de seguridad',
                text: 'Hubo un problema en el usuario',
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

function enviaAjax2(datos, accion) {
    $.ajax({
        async: true,
        url: '', //la pagina a donde se envia por estar en mvc, se omite la ruta ya que siempre estaremos en la misma pagina
        type: 'POST', //tipo de envio 
        contentType: false,
        data: datos,
        processData: false,
        cache: false,
        success: function(respuesta) {
            console.log(respuesta);
            //si resulto exitosa la transmision
            mostrarDatosusuario();

            Swal.fire({
                title: 'Usuario Eliminado exitosamente',
                text: "",
                icon: 'success',
                timer: 4000, // Establece el tiempo en milisegundos (5 segundos en este caso)

            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {
                    // Esto se ejecutará después de que se cierre el mensaje automáticamente
                    console.log('Mensaje modal cerrado');
                }
            });


        },
        error: function() {

            Swal.fire({
                title: 'Error al ingresar la materia primar',
                text: 'Hubo un problema al registrar la materia primar.',
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


function llenarLista() {
    console.log("llena lista");
    var datos = new FormData();
    datos.append('accion', 'consultar');
    enviaAjax(datos, 'consultar');
}


//console.log("aisdioj");


function mensajemodal(mensaje) {

    $("#contenidodemodal").html(mensaje);
    $("#mostrarmodal").modal("show");
    setTimeout(function() {
        $("#mostrarmodal").modal("hide");
    }, 4000);
}



function validarselect() {
    // Obtener los valores de los campos select
    var valorOpcion1 = document.getElementById('id_pregunta_s').value;

    // Validar si alguno de los campos tiene valor 0
    if (valorOpcion1 === '0') {
        console.log("fuera d ranking");

        return false; // Evita que el formulario se envíe
    }

    // Si llegamos aquí, el formulario es válido y se puede enviar
    return true;
}

function borrar(valor) {
    var datos = new FormData();
    datos.append('accion', 'eliminar');
    datos.append('nuevo_usuario', valor);
    enviaAjax2(datos, 'eliminar');
}

function mostrarDatosusuario() {
    // La función realiza una petición AJAX al archivo mostrarDatosmateria_prima.php
    console.log("entrando data DatosUsuario");

    $.ajax({ url: './Modelo/mostrarDatosUsuario.php' }).done(function(r) {
        // Cuando se recibe la respuesta de la petición AJAX, se agrega la tabla al elemento con el ID 'tablaDatosDatosUsuariomostrarDatosusuario'
        console.log("Mostrando data satisfactoriamente");
        $('#tablaDatosusuario').html(r);
        $('#tablausuario').DataTable({
            "language": {
                "url": "./js/es-ES.json"
            }
        });
        $('tr').click(function() {
            console.log("dsdsd");
            // Obtiene el valor de la columna 'nuevo_usuario' de la fila clicada
            var nuevo_usuario = $(this).find('td:eq(1)').text();
            var nombres = $(this).find('td:eq(2)').text();
            var apellidos = $(this).find('td:eq(4)').text();

            // Coloca el valor en el input con id 'nuevo_usuario'
            $('#nuevo_usuario').val(nuevo_usuario);
            $('#nombres').val(nombres);
            $('#apellidos').val(apellidos);
            $('#staticBackdrop').modal('show');
            $('#accion').val("modificar");
            $('#staticBackdropLabel').text('Modificar usuario');

        });




    });
}