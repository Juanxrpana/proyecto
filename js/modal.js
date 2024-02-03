// Obtener el modal
var modal = document.getElementById("myModal");

// Obtener el botón que abre el modal
var btn = document.getElementById("openModalBtn");

// Obtener el elemento <span> que cierra el modal
var span = document.getElementsByClassName("close")[0];

// Cuando el usuario haga clic en el botón, abrir el modal
btn.onclick = function() {
    event.preventDefault();
    modal.style.display = "block";
    mostrarDatosprov();
}

// Cuando el usuario haga clic en <span> (x), cerrar el modal
span.onclick = function() {
    modal.style.display = "none";
}

// Cuando el usuario haga clic en cualquier parte fuera del modal, cerrar el modal
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}


function mostrarDatosprov() {
    // La función realiza una petición AJAX al archivo mostrarDatosmateria_prima.php
    /*  console.log("entrando mostrando data Datosmateria_prima"); */

    $.ajax({ url: './Modelo/mostrarDatosproveedormodal.php' }).done(function(r) {
        // Cuando se recibe la respuesta de la petición AJAX, se agrega la tabla al elemento con el ID 'tablaDatosDatosmateria_prima'
        console.log("Mostrando data de materiaprima satisfactoriamente");
        $('#tablaDatosProveedor').html(r);
        $('#tablaproveedor').DataTable({
            "language": {
                "url": "./js/es-ES.json"
            }
        });
    });

}