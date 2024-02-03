//En esta parte añadiremos el codigo necesario para validar antes de enviar
//al servidor, anteriormente validamos las entradas, pero es necesario
//verificar antes de enviar que a pesar de que se le dijo al usuario que hacer
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
mostrarproveedor();
mostrarmateria_prima();

function mostrarproveedor() {
    // La función realiza una petición AJAX al archivo mostrarproveedor.php
    console.log("entrando mostrando data proveedor");

    $.ajax({ url: './modelo/mostrarDatosProveedor.php' }).done(function(r) {
        // Cuando se recibe la respuesta de la petición AJAX, se agrega la tabla al elemento con el ID 'tablaDatosproveedor'
        console.log("Mostrando data proveedor satisfactoriamente");
        $('#tablaDatosproveedor').html(r);
    });
}

function mostrarmateria_prima() {
    // La función realiza una petición AJAX al archivo mostrarmateria_prima.php
    console.log("entrando mostrando data materia_prima_reporte");

    $.ajax({ url: './modelo/mostrarDatosmateria_prima_reporte.php' }).done(function(r) {
        // Cuando se recibe la respuesta de la petición AJAX, se agrega la tabla al elemento con el ID 'tablaDatosmateria_prima'
        console.log("Mostrando data materia_prima satisfactoriamente");
        $('#tablaDatosmateria_prima').html(r);
    });
}

function generar_reporte_compra(boton) {
    var idcompra = boton.getAttribute('data-id');
    var proveedor = document.getElementById('datos_prov_identificacion').innerText;

    var datos = new FormData();
    datos.append('accion', 'generar');
    datos.append('idcompra', idcompra);
    datos.append('proveedor', proveedor);
    console.log(proveedor);

    enviaAjax(datos, 'generar');

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
                    title: 'Factura exitosa',
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
                title: 'Success',
                text: 'Factura registrada.',
                icon: 'success',
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