document.getElementById('agregar-usuario-form').addEventListener('submit', function (e) {
    e.preventDefault();

    const nombre = document.getElementById('name').value;
    const correo = document.getElementById('email').value;

});


document.addEventListener("DOMContentLoaded", function () {
document.getElementById("formEliminar").addEventListener("submit", function(event) {
    event.preventDefault();

    var idBorrar = document.getElementById("idUser").value;

    document.getElementById("formEliminar").action = "/usuarios/"+idBorrar;
    document.getElementById("formEliminar").method = "DELETE";
    document.getElementById("formEliminar").submit();
});
});
