$(document).ready(function() {
    mostrarDatoscafe_tostado();
    mostrarcontador_materia_prima();
    mostrarcontador();


    $("#incluir").on("click", function() {
        /*  alert("Funciona"); */
        var datos = new FormData();
        datos.append('accion', 'incluir');
        datos.append('nivel_tostado', $("#nivel_tostado").val());
        datos.append('nivel_molido', $("#nivel_molido").val());
        datos.append('cantidad', $("#cafe-input").val());
        if (validarSuma()) {
            // Si todos los campos son válidos, envía los datos al servidor
            enviaAjax(datos, 'incluir');
            descontador();
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'Error',
                text: 'No se pueden tostar mas de 5 quintales a la vez. No se tostaran menos de 5 quintales a la vez'
            });
        }
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
    console.log("validarsumatostado");
    var contador = parseInt(document.getElementById('contador_cafe_tostado').innerText);
    var cantidad1 = parseInt(document.getElementById('cafe-input').value) || 0;
    var total = cantidad1 + contador;
    if (total != 5) {
        // Utilizar SweetAlert para mostrar el mensaje
        Swal.fire({
            icon: 'warning',
            title: 'Error',
            text: 'No se pueden tostar mas de 5 quintales a la vez. No se tostaran menos de 5 quintales a la vez',
        });
        return false;
    } else {
        console.log("cantidad valida");
        return true;

    }
}

function borrarcafe_tostado(valor) {
    var datos = new FormData();
    datos.append('accion', 'eliminar');
    datos.append('idcafe_tostado', valor);
    enviaAjax2(datos, 'eliminar');


}

function modificarDatos(valor) {
    var datos = new FormData();
    /*  alert("Modificar funciona"); */
    datos.append('accion', 'modificar');
    datos.append('cantidad', $("#cafe-input").val());
    datos.append('nivel_tostado', $("#nivel_tostado").val());
    datos.append('nivel_molido', $("#nivel_molido").val());

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
            //si resulto exitosa la transmision
            if (accion == "consultar") {
                $("#proveedor").html(respuesta);
            } else {


                mostrarDatoscafe_tostado();
                mostrarcontador_materia_prima();



                /*  mostrarcontador(); */

                $("#hola").html(respuesta);
                Swal.fire({
                    title: 'Datos ingresados exitosamente',
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
            //si resulto exitosa la transmision
            if (accion == "consultar") {
                $("#proveedor").html(respuesta);
            } else {


                mostrarDatoscafe_tostado();



                /*  mostrarcontador(); */

                $("#hola").html(respuesta);
                Swal.fire({
                    title: 'Datos eliminados exitosamente',
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

function mostrarDatoscafe_tostado() {
    // La función realiza una petición AJAX al archivo mostrarDatoscafe_tostado.php
    /*  console.log("entrando mostrando data Datoscafe_tostado"); */

    $.ajax({ url: './Modelo/mostrarDatoscafe_tostado.php' }).done(function(r) {
        // Cuando se recibe la respuesta de la petición AJAX, se agrega la tabla al elemento con el ID 'tablaDatosDatoscafe_tostado'
        console.log("Mostrando data de cafe tostado satisfactoriamente");
        $('#tablaDatoscafe_tostado').html(r);
        $('#tabla_cafe_tostado').DataTable({
            "language": {
                "url": "./js/es-ES.json"
            }
        });

        mostrarcontador();
    });
}

function mostrarcontador() {
    $.ajax({ url: './Modelo/contador_cafe_tostado.php' }).done(function(r) {
        console.log("Mostrando contador satisfactoriamente");
        $('#contador_cafe_tostado').html(r);
    });
}

function mostrarcontador_materia_prima() {
    $.ajax({ url: './Modelo/contador_materia_prima.php' }).done(function(r) {
        console.log("Mostrando contador satisfactoriamente");
        $('#contador_materia_prima').html(r);
    });
}




function descontador() {
    $.ajax({ url: './Modelo/descontador_materia_prima.php' }).done(function(r) {
        console.log("desconto satisfactoriamente");
    });
}