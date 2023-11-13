$(document).ready(function() {
    $('.formularioModificar').hide();
    $('.Articulos').hide();
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
        $(this).siblings('.formularioModificar').slideDown(500);
        $(this).siblings('.btnCancelar').show();
        $(this).hide();
    });

    $('.btnVerArticulos').click(function() {
        $(this).siblings('.Articulos').slideDown(500);
        $(this).siblings('.btnCancelar').show();
        $(this).hide();
    });

    $('.btnCancelar').click(function() {
        $(this).siblings('.Articulos').slideUp(500);
        $(this).siblings('.formularioModificar').slideUp(500);
        $(this).siblings('.btnVerArticulos').show();
        $(this).siblings('.btnModificar').show();
        $(this).hide();
    });

});


