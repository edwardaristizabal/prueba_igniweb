var tabla;

//Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();

    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    });
    //$('#mAlmacen').addClass("treeview active");
    // $('#lusuarios').addClass("active");
}

//Función limpiar
function limpiar() {
    $("#codigo_trabajador").val("");
    $("#num_documento").val("");
    $("#nombre").val("");
    $("#profesion").val("");
    $("#cargo").val("");
    $("#direccion").val("");
    $("#telefono").val("");
    $("#email").val("");
    $("#login").val("");
    $("#clave").val("");
    $("#idusuario").val("");
}

//Función mostrar formulario
function mostrarform(flag) {
    limpiar();
    if (flag) {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled", false);
        $("#btnagregar").hide();
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
            url: '../ajax/usuario.php?op=listar',
            type: "get",
            dataType: "json",
            error: function(e) {
                console.log(e.responseText);
            }
        },
        "language": {
            "lengthMenu": "Show: _MENU_ records",
            "buttons": {
                "copyTitle": "Tabla Copiada",
                "copySuccess": {
                    _: '%d líneas copiadas',
                    1: '1 línea copiada'
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
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/usuario.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos) {
            bootbox.alert(datos);
            mostrarform(false);
            tabla.ajax.reload();
        }

    });
    limpiar();
}

function mostrar(idusuario) {
    $.post("../ajax/usuario.php?op=mostrar", { idusuario: idusuario }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);

        $("#codigo_trabajador").val(data.codigo_trabajador);
        $("#num_documento").val(data.num_documento);
        $("#nombre").val(data.nombre);
        $("#profesion").val(data.profesion);
        $("#cargo").val(data.cargo);
        $("#direccion").val(data.direccion);
        $("#telefono").val(data.telefono);
        $("#email").val(data.email);
        $("#login").val(data.login);
        $("#clave").val(data.clave);
        $("#idusuario").val(data.idusuario);

    })
}
/*
 *Funcion: eliminar
 *Para eliminar un registro
 */
function eliminarFila(idusuario) {
    bootbox.confirm("¿Are you sure to delete the user?", function(result) { // confirmamos con una pregunta si queremos eliminar
        if (result) {
            $.post("../ajax/usuario.php?op=eliminar", { idusuario: idusuario }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }

    })
}
init();