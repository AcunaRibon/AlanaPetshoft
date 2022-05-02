// Estilo

const swalA = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-primary mx-1',
        cancelButton: 'btn btn-secondary mx-1'
    },
    buttonsStyling: false
})

// Mensaje dependiendo de la vista

var mensaje = $('#mensajeAlerta').val();

// Alertas confirmar envío del formulario

$('.registrar').on('click', function(e){
    e.preventDefault();
    var form = event.target.form;

    swalA.fire({
        title: '¿Deseas registrar ' + mensaje + '?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí',
        cancelButtonText: 'No',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    })
});

$('.actualizar').on('click', function(e){
    e.preventDefault();
    var form = event.target.form;

    swalA.fire({
        title: '¿Deseas modificar ' + mensaje + '?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí',
        cancelButtonText: 'No',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    })
});

$('.reporte').on('click', function(e){
    e.preventDefault();
    var form = event.target.form;

    swalA.fire({
        title: '¿Deseas generar el reporte?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí',
        cancelButtonText: 'No',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    })
});

$('.cancelar').on('click', function(e){
    e.preventDefault();
    var form = event.target.form;

    swalA.fire({
        title: '¿Deseas cancelar ' + mensaje + '?',
        text: "Si lo haces, no se tendrá en cuenta para procesos del negocio.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí',
        cancelButtonText: 'No',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    })
});

// Alertas luego de confirmar envío

var tipoAlerta = $('#tipoAlerta').val();
var mensajeAlerta1 = $('#mensajeAlerta1').val();
var mensajeAlerta2 = $('#mensajeAlerta2').val();

var mensajeAlerta3 = 'o';
if(mensajeAlerta2.substring(0,2) == 'La')
{
    mensajeAlerta3 = 'a';
}

if(tipoAlerta == 'registrado')
{
    swalA.fire(
        mensajeAlerta1 + ' registrad' + mensajeAlerta3,
        mensajeAlerta2 + ' ha sido registrad' + mensajeAlerta3 + ' con éxito.',
        'success'
    )
} 
if(tipoAlerta == 'actualizado')
{
    swalA.fire(
        mensajeAlerta1 + ' actualizad' + mensajeAlerta3,
        mensajeAlerta2 + ' ha sido actualizad' + mensajeAlerta3 + ' con éxito.',
        'success'
    )
}
if(tipoAlerta == 'cancelado')
{
    swalA.fire(
        mensajeAlerta1 + ' cancelad' + mensajeAlerta3,
        mensajeAlerta2 + ' ha sido cancelad' + mensajeAlerta3 + ' con éxito.',
        'success'
    )
}
if(tipoAlerta == 'restaurado')
{
    swalA.fire(
        mensajeAlerta1 + ' restaurad' + mensajeAlerta3,
        mensajeAlerta2 + ' ha sido restaurad' + mensajeAlerta3 + ' con éxito.',
        'success'
    )
}
if(tipoAlerta == 'listado'){}
if(tipoAlerta == 'errorRegistrar')
{
    swalA.fire(
        'Error al registrar ' + mensaje,
        'Por favor revise si ingresó la información solicitada de forma correcta.',
        'error'
    )
}
if(tipoAlerta == 'errorModificar')
{
    swalA.fire(
        'Error al modificar ' + mensaje,
        'Por favor revise si ingresó la información solicitada de forma correcta.',
        'error'
    )
}
if(tipoAlerta == 'errorInforme')
{
    swalA.fire(
        'Error al generar el reporte',
        'Por favor revise si ingresó la información solicitada de forma correcta.',
        'error'
    )
}
if(tipoAlerta == 'error')
{
    swalA.fire(
        'Error inesperado',
        'Por favor reportar inmediatamente al administrador.',
        'error'
    )
}

if(tipoAlerta == 'Cantidad excedida')
{
    swalA.fire(
        'Cantidad excedida',
        'La cantidad que desea no se encuentra disponible',
        'error'
    )
}