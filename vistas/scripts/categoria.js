var tabla;
//Funcion que se ejecuta al inicio
function init(){
    mostrarform(false);
    listar();

    $("#formulario").on("submit", function(e)
    {
        guardaryeditar(e);
    })
}

//Funcion limpiar
function limpiar()
{
    $("#idcategoria").val("");
    $("#nombre").val("");
    $("#descripcion").val("");
}

//Función mostrar formulario
function mostrarform(flag)
{
    limpiar();
    if (flag)
    {
        $("#listadoregistros").hide()
    }
}

function cancelarform()
{

}

function listar()
{
    tabla=$('#tblisado').dataTable({

    }
    )
}

//funció guardar o editar
function guardaryeditar(e)
{
    e.preventDefault();                         //no se activara la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/categoria.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos)
        {
            bootbox.alert(datos);
            mostrarform(false);
            tabla.ajax.reload();
        }
    });
    limpiar();
}

function mostrar(idcategoria)
{
    $.post("../jax/categoria.php?op=mostrar", {idcategoria : idcategoria}, function(data, status)
    {
        data = JSON.parse(data);
        mostrarform(true);

        $("#nombre").val(data.nombre);
        $("#descripcion").val(data.idcategoria);
    })
}

//Función para desactiavr registros
function desactivar(idcategoria)
{
        bootbox.confirm("¿Está seguro de desactivar la categoría?", function(result){
            if(result)
            {
                $.post("../jax/categoria.php?op=desactivar", {idcategoria : idcategoria}, function(e){
                    bootbox.alert(e);
                    tabla.ajax.reload();
                })
            }
        })
}

init(); 