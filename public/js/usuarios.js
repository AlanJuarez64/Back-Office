// Agregar usuario
document.getElementById('agregar-usuario-form').addEventListener('submit', function (e) {
    e.preventDefault();

    const nombre = document.getElementById('name').value;
    const correo = document.getElementById('email').value;

});

// Eliminar usuario
document.addEventListener("DOMContentLoaded", function () {
document.getElementById("formEliminar").addEventListener("submit", function(event) {
    event.preventDefault(); // Evita que el formulario se envíe de inmediato

    // Obtiene el valor ingresado en el campo de texto
    var idBorrar = document.getElementById("idUser").value;

    // Actualiza el atributo 'action' del formulario con el valor ingresado
    document.getElementById("formEliminar").action = "/usuarios/"+idBorrar;
    document.getElementById("formEliminar").method = "DELETE";
    // Envía el formulario
    document.getElementById("formEliminar").submit();
});
});