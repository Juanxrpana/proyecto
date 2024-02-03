$(document).ready(function() {

    mostrarDatosmateria_prima();
    llenarLista();
    llenar_contador_total();

    $("#incluir").on("click", function() {
        var datos = new FormData();
        datos.append('accion', 'incluir');
        datos.append('proveedor', $("#proveedor").val());
        datos.append('fecha', $("#fecha").val());
        datos.append('calidad1', $("#calidad1").val());
        datos.append('calidad2', $("#calidad2").val());
        datos.append('cantidad1', $("#cantidad1").val());
        datos.append('cantidad2', $("#cantidad2").val());
        if (validarSuma()) {
            if (validarselect()) {
                // Si todos los campos son válidos, envía los datos al servidor
                enviaAjax(datos, 'incluir');
                enviaAjax_imprimir(datos, 'generar_individual');

            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Hay un error en los datos',
                    text: ' Falta el proveedor'
                });
            }
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'Error en almacén',
                text: 'El almacén no tiene capacidad para recibir esta cantidad de materia prima. Debe vaciar almacén.'
            });
        }
    });

    $("#incluir").on("click", function() {
        var datos = new FormData();
        datos.append('accion', 'generar_individual');
        datos.append('proveedor', $("#proveedor").val());
        datos.append('idcompra', idcompra);
        enviaAjax_imprimir(datos, 'generar_individual');
        //imprime


    });





});

document.addEventListener('DOMContentLoaded', function() {
    var nivel_usuario = document.getElementById("nivelUsuario").value;
    // Obtener el elemento de la lista de proveedores y si es usuario, entonces se elimina proveedores
    if (nivel_usuario == 1) {

        proveedores = document.getElementById("proveedor-lista");
        usuarios = document.getElementById("usuario-lista");
        if (proveedores || usuarios) {
            console.log("Eliminando proveedores y usuarios");
            proveedores.parentNode.removeChild(proveedores);
            usuarios.parentNode.removeChild(usuarios);
        };


    }

});

function validarSuma() {
    console.log("validarSuma");
    var contador = parseInt(document.getElementById('contador_materia_prima').innerText);
    var cantidad1 = parseInt(document.getElementById('cantidad1').value) || 0;
    var cantidad2 = parseInt(document.getElementById('cantidad2').value) || 0;
    var suma = cantidad1 + cantidad2;
    var total = suma + contador;
    if (total > 2000) {
        // Utilizar SweetAlert para mostrar el mensaje
        Swal.fire({
            icon: 'warning',
            title: 'Error',
            text: 'Ya hay 2000 quintaleses. Por favor, verifica la información.',
        });
        return false;
    } else {
        return true;
    }
}

function validarselect() {
    console.log("validarselect");
    // Obtener los valores de los campos select
    var valorOpcion1 = document.getElementById('proveedor').value;
    // Validar si alguno de los campos tiene valor 0
    if (valorOpcion1 === '') {
        console.log("fuera d ranking");
        return false; // Evita que el formulario se envíe
    }
    // Si llegamos aquí, el formulario es válido y se puede enviar
    else {
        console.log("en ranking");
        return true;

    }
}

function borrarmateria_prima(valor) {
    var datos = new FormData();
    datos.append('accion', 'eliminar');
    datos.append('idcompra', valor);
    enviaAjax2(datos, 'eliminar');
}

function modificarDatos(valor) {
    var datos = new FormData();
    datos.append('accion', 'modificar');
    datos.append('fecha', $("#fecha").val());
    datos.append('calidad1', $("#calidad1").val());
    datos.append('calidad2', $("#calidad2").val());
    datos.append('cantidad1', $("#cantidad1").val());
    datos.append('cantidad2', $("#cantidad2").val());
    console.log(valor);
    datos.append('idcompra', valor);
    enviaAjax(datos, 'modificar');
}

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
                $("#proveedor").html(respuesta);
            } else {
                mostrarDatosmateria_prima();
                llenar_contador_total();

                Swal.fire({
                    title: 'Cantidad registrada exitosamente',
                    text: respuesta,
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
            if (accion == "consultar") {
                $("#proveedor").html(respuesta);
            } else {
                mostrarDatosmateria_prima();
                llenar_contador_total();

                Swal.fire({
                    title: 'Cantidad eliminada exitosamente',
                    text: respuesta,
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
                title: 'Error al eliminar el registro',
                text: 'Verifique los datos',
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
    var datos = new FormData();
    datos.append('accion', 'consultar');
    enviaAjax(datos, 'consultar');
}



function mostrarDatosmateria_prima() {
    // La función realiza una petición AJAX al archivo mostrarDatosmateria_prima.php
    /*  console.log("entrando mostrando data Datosmateria_prima"); */

    $.ajax({ url: './Modelo/mostrarDatosmateria_prima.php' }).done(function(r) {
        // Cuando se recibe la respuesta de la petición AJAX, se agrega la tabla al elemento con el ID 'tablaDatosDatosmateria_prima'
        console.log("Mostrando data de materiaprima satisfactoriamente");
        $('#tablaDatosmateria_prima').html(r);
        $('#tabla_materia_prima').DataTable({
            "language": {
                "url": "./js/es-ES.json"
            }
        });
    });

}



function llenar_contador_total() {
    $.ajax({ url: './Modelo/contador_materia_prima.php' }).done(function(r) {
        console.log("Mostrando contador satisfactoriamente");
        $('#contador_materia_prima').html(r);
    });
}




function enviaAjax_imprimir(datos, accion) {
    $.ajax({
        async: true,
        url: '', //la pagina a donde se envia por estar en mvc, se omite la ruta ya que siempre estaremos en la misma pagina
        type: 'POST', //tipo de envio 
        contentType: false,
        data: datos,
        processData: false,
        cache: false,
        success: function(respuesta) {
            //si resulto exitosa la transmision
            if (accion == "consultar") {
                $("#proveedor").html(respuesta);
            } else {

                console.log("imprimir");
                Swal.fire({
                    title: 'Proveedor ingresado exitosamente',
                    text: respuesta,
                    icon: 'success',
                    timer: 4033330, // Establece el tiempo en milisegundos (5 segundos en este caso)

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
                title: 'Error al ingresar el proveedor',
                text: 'Hubo un problema al registrar el proveedor.',
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