$(document).ready(function() {
    $('.formularioModificar').hide();
    $('.btnCancelar').hide();
    $("tr:gt(25)").hide();
    $("#Ocultar").hide();
    $("#verTodos").click(function(e) {
        e.preventDefault();
        $("tr").fadeIn();
        $("#verTodos").hide();
        $("#Ocultar").fadeIn();
    });
    $("#Ocultar").click(function(e) {
        e.preventDefault();
        $("tr:gt(25)").fadeOut();
        $("#Ocultar").hide();
        $("#verTodos").fadeIn();
    });

    $('.btnModificar').click(function() {
        $(this).siblings('.formularioModificar').slideDown(1000);
        $(this).siblings('.btnCancelar').show();
        $(this).hide();
    });

    $('.btnCancelar').click(function() {
        $(this).siblings('.formularioModificar').slideUp(1000);
        $(this).siblings('.btnModificar').show();
        $(this).hide();
    });

});


