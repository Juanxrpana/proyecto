$(document).ready(function() {
    $('#menu-toggle').click(function() {
        $('.sidebar').toggleClass('show-sidebar');
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