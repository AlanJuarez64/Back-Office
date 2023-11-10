$(document).ready(function() {
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
});


