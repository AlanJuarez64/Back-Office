$(document).ready(function() {
    $('.cambiarFuncionario').hide();
    $('.errores').hide();
    $('.btnOcultarErrores').hide();
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
        $(this).siblings('.cambiarFuncionario').slideUp(500);
        $(this).siblings('.btnVerArticulos').show();
        $(this).siblings('.btnModificar').show();
        $(this).siblings('.btnCambiarFuncionario').show();
        $(this).hide();
    });

    $('.btnCambiarFuncionario').click(function() {
        $(this).siblings('.cambiarFuncionario').slideDown(500);
        $(this).siblings('.btnCancelar').show();
        $(this).hide();
    });

    $('.btnErrores').click(function() {
        $(this).siblings('.errores').slideDown(1000);
        $('.btnErrores').hide();
        $('.btnOcultarErrores').show();
    });

    $('.btnOcultarErrores').click(function() {
        $(this).siblings('.errores').slideUp(1000);
        $('.btnOcultarErrores').hide();
        $('.btnErrores').show();
    });

});


