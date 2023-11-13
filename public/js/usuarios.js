$(document).ready(function() {
    $('.formularioModificar').hide();
    $('#btnOcultarErrores').hide();
    $('.errores').hide();

    $('.btnModificar').click(function() {
        $(this).siblings('.formularioModificar').slideDown(1000);
    });

    $('#btnErrores').click(function() {
        $(this).siblings('.errores').slideDown(1000);
        $('#btnErrores').hide();
        $('#btnOcultarErrores').show();
    });

    $('#btnOcultarErrores').click(function() {
        $(this).siblings('.errores').slideUp(1000);
        $('#btnOcultarErrores').hide();
        $('#btnErrores').show();
    });
});
