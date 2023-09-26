$(document).ready(function() {
    $("tr:gt(45)").hide();
    $("#Ocultar").hide();
    $("#verTodos").click(function(e) {
        e.preventDefault();
        $("tr").fadeIn();
        $("#verTodos").hide();
        $("#Ocultar").fadeIn();
    });
    $("#Ocultar").click(function(e) {
        e.preventDefault();
        $("tr:gt(45)").fadeOut();
        $("#Ocultar").hide();
        $("#verTodos").fadeIn();
    });
});


