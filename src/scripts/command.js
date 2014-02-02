var beentocorridor = true;
var sword = false;
var currentroom = "n_corridor";

$(document).ready(function() {
    $("form").submit(function() {
       var input = $("#command_line").val();
       
       if (input == "help") {
            $("#message_help").hide().clone().insertBefore("#placeholder").fadeIn(1000);
       }

       $("#command_line").val("");
    });

    if (sword == true) {
        $("#message_help").hide().clone().insertBefore("#placeholder").fadeIn(1000);
    }
});