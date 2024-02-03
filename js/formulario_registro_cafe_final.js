$(document).ready(function() {
    mostrarDatoscafe_tostado_final();
    mostrarDatoscafe_final();
    mostrarcontador();
    mostrarcontador_materia_prima();
    mostrarcontador_cafe_final();



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


function incluir_final(boton) {

    var cantidad = document.getElementById('cantidad').innerText;
    var cantidad_paquetes = (parseFloat(cantidad) * 37) / 5;
    var cantidad_paquetesredondeado = Math.round(cantidad_paquetes, 2);

    var idcafe_tostado = boton.getAttribute('data-id');

    var datos = new FormData();
    datos.append('accion', 'incluir');
    datos.append('idcafe_tostado', idcafe_tostado); //toma el id de la tabla
    datos.append('cantidad_paquetes', cantidad_paquetes);

    console.log(idcafe_tostado);
    console.log("cantidad" + cantidad);
    console.log("Cantidad Paquetes: " + cantidad_paquetes);
    console.log("Cantidad Paquetesredondeado: " + cantidad_paquetesredondeado);

    var elementoTexto = document.createElement('span');
    elementoTexto.className = 'finalizado';
    elementoTexto.setAttribute('data-id', idcafe_tostado);
    elementoTexto.textContent = 'Finalizado';

    boton.parentNode.replaceChild(elementoTexto, boton);

    enviaAjax(datos, 'incluir');
    descontador_cafe_tostado();
    actualizadorajax();


}

function limite() {
    var cafe_final = document.getElementById('cafe_final').innerText;
    if (cafe_final == 3000) {
        Swal.fire({
            icon: 'warning',
            title: 'Error',
            text: 'No se pueden tostar mas de 5 quintales a la vez. No se tostaran menos de 5 quintales a la vez',
        });
    }
    return false;
}

function borrarcafe_final(valor) {
    var datos = new FormData();
    datos.append('accion', 'eliminar');
    datos.append('id_cafe_final', valor);
    enviaAjax(datos, 'eliminar');
}

function modificarDatos(valor) {
    var datos = new FormData();
    alert("Modificar funciona");
    datos.append('accion', 'modificar');
    datos.append('nivel_tostado', $("#nivel_tostado").val());
    datos.append('nivel_molido', $("#nivel_molido").val());
    console.log(valor);
    console.log("sadasd");
    datos.append('idcafe_tostado', valor);
    enviaAjax(datos, 'modificar');


}


function actualizadorajax() {
    console.log("actualizadorajax");
    $.ajax({
        async: true,
        url: '', //la pagina a donde se envia por estar en mvc, se omite la ruta ya que siempre estaremos en la misma pagina
        type: 'POST', //tipo de envio 
        contentType: false,
        processData: false,
        cache: false,
        success: function() {

            /*  mostrarDatoscafe_tostado_final(); */
            mostrarDatoscafe_final();
            mostrarcontador();
            mostrarcontador_materia_prima();
            mostrarcontador_cafe_final();
            console.log("actualizadorajax parte2");

        },
        error: function() {
            Swal.fire({
                title: 'Error al cargar las tablas',
                text: 'Recargue la pagina por favor',
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
                $("#hola").html(respuesta);
                Swal.fire({
                    title: 'Bultos de café ingresados exitosamente',
                    text: respuesta,
                    icon: 'success',
                    timer: 4000

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

function mostrarDatoscafe_final() {
    // La función realiza una petición AJAX al archivo mostrarDatoscafe_tostado.php
    /*  console.log("entrando mostrando data Datoscafe_tostado"); */

    $.ajax({ url: './Modelo/mostrarDatoscafe_final.php' }).done(function(r) {
        // Cuando se recibe la respuesta de la petición AJAX, se agrega la tabla al elemento con el ID 'tablaDatosDatoscafe_tostado'
        console.log("Mostrando data de cafe final");

        $('#tablaDatoscafe_final').html(r);
        $('#tabla_cafe_final').DataTable({
            "language": {
                "url": "./js/es-ES.json"
            }
        });
        /* mostrarcontador(); */
    });
}

function mostrarDatoscafe_tostado_final() {
    // La función realiza una petición AJAX al archivo mostrarDatoscafe_tostado.php
    /*  console.log("entrando mostrando data Datoscafe_tostado"); */

    $.ajax({ url: './Modelo/mostrarDatoscafe_tostado_final.php' }).done(function(r) {
        // Cuando se recibe la respuesta de la petición AJAX, se agrega la tabla al elemento con el ID 'tablaDatosDatoscafe_tostado'
        console.log("Mostrando data de cafe tostado satisfactoriamente");
        $('#tablaDatoscafe_tostado_final').html(r);
        $('#tabla_cafe_tostado').DataTable({
            "language": {
                "url": "./js/es-ES.json"
            }
        });
        /*  mostrarcontador(); */
    });
}


function descontador_cafe_tostado() {
    $.ajax({ url: './Modelo/descontador_cafe_tostado.php' }).done(function(r) {
        console.log("cafe tostado a 0");
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

function mostrarcontador_cafe_final() {
    $.ajax({ url: './Modelo/contador_cafe_final.php' }).done(function(r) {
        console.log("Mostrando contador final satisfactoriamente");
        $('#contador_cafe_final').html(r);
    });
}