$("#frmAcceso").on('submit', function(e) {
    e.preventDefault();
    loginf = $("#loginf").val();
    clavef = $("#clavef").val();

    $.post("../ajax/usuario.php?op=verificar", { "loginf": loginf, "clavef": clavef },
        function(data) {
            if (data != "null") {
                $(location).attr("href", "prestamo.php");
            } else {
                bootbox.alert("Usurio y/o Password incorrectos");
            }
        });
})