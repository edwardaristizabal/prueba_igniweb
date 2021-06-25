var tabla;

//Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();

    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    });

    //Cargamos los items al combobox libro
    $.post("../ajax/prestamo.php?op=SelectLibro", function(r) {
        $("#idlibro").html(r);
        $('#idlibro').selectpicker('refresh');
    });

}

//Función limpiar
function limpiar() {

    $("#cantidad").val("");
    $("#observacion").val("");
    $("#idprestamo").val("");
    $("#observacion").val("");

    //Obtenemos la fecha actual
    var now = new Date();
    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    var today = now.getFullYear() + "-" + (month) + "-" + (day);
    $('#fecha_prestamo').val(today);

    var now = new Date();
    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    var today = now.getFullYear() + "-" + (month) + "-" + (day);
    $('#fecha_devolucion').val(today);

}

//Función mostrar formulario
function mostrarform(flag) {
    limpiar();
    if (flag) {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").show();
        $("#btnCancelar").show();
    } else {
        $("#listadoregistros").show();
        $("#formularioregistros").hide();
        $("#btnagregar").show();
    }
}

//Función cancelarform
function cancelarform() {
    limpiar();
    mostrarform(false);
}

//Función Listar
function listar() {
    tabla = $('#tbllistado').dataTable({
        "lengthMenu": [5, 10, 25, 75, 100], //mostramos el menú de registros a revisar
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor
        dom: '<Bl<f>rtip>', //Definimos los elementos del control de tabla
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdf'
        ],
        "ajax": {
            url: '../ajax/prestamo.php?op=listar',
            type: "get",
            dataType: "json",
            error: function(e) {
                console.log(e.responseText);
            }
        },
        "language": {
            "lengthMenu": "Mostrar : _MENU_ records",
            "buttons": {
                "copyTitle": "Copied table",
                "copySuccess": {
                    _: '%d copied lines',
                    1: '1 copied line'
                }
            }
        },
        "bDestroy": true,
        "iDisplayLength": 5, //Paginación
        "order": [
                [0, "desc"]
            ] //Ordenar (columna,orden)
    }).DataTable();
}
//Función para guardar o editar

function guardaryeditar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    //$("#btnGuardar").prop("disabled",true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/prestamo.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos) {
            bootbox.alert(datos);
            mostrarform(false);
            listar();
        }

    });
    limpiar();
}

function mostrar(idprestamo) {
    $.post("../ajax/prestamo.php?op=mostrar", { idprestamo: idprestamo }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);


        $("#idlibro").val(data.idlibro);
        $('#idlibro').selectpicker('refresh');
        $("#fecha_prestamo").val(data.fecha_prestamo);
        $("#fecha_devolucion").val(data.fecha_devolucion);
        $("#cantidad").val(data.cantidad);
        $("#observacion").val(data.observacion);
        $("#idprestamo").val(data.idprestamo);

        //Ocultar y mostrar los botones
        $("#btnGuardar").hide();
        $("#btnCancelar").show();
        $("#btnagregar").hide();


    })
}

//Función para anular registros
function anular(idprestamo) {
    bootbox.confirm("¿Return of the book?", function(result) {
        if (result) {
            $.post("../ajax/prestamo.php?op=anular", { idprestamo: idprestamo }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

init();