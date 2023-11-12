$(document).ready(function() {
    $('.ConfirmacionFinal').hide();
    $('.btnCancelar').hide();

    $('.btnConfirmar').click(function() {
        $(this).siblings('.ConfirmacionFinal').slideDown(500);
        $(this).siblings('.btnCancelar').show();
        $(this).hide();
    });

    $('.btnCancelar').click(function() {
        $(this).siblings('.ConfirmacionFinal').slideUp(500);
        $(this).siblings('.btnConfirmar').show();
        $(this).hide();
    });
});