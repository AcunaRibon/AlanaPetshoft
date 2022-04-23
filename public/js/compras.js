// Registrar

function agregarPrecioProducto() 
{
    let precio = $("#producto_id option:selected").attr("precio");
    $("#precio_producto").val(precio);
    
}

function agregarProducto()
{
    let idProducto = $("#producto_id option:selected").val();
    let nombreProducto = $("#producto_id option:selected").text();
    let cantidadProducto = $("#cantidad_detalle_compra").val();
    let precioProducto = $("#precio_producto").val();

    if (cantidadProducto > 0 && precioProducto > 0)
    {
        $('#tablaProductos').append(`
            <tr id="producto-${idProducto}">
                <td>
                    <input type="hidden" name="producto_id[]" value="${idProducto}" required></input>
                    <input type="hidden" name="cantidad_detalle_compra[]" value="${cantidadProducto}" required></input>
                    ${idProducto}
                </td>
                <td>${nombreProducto}</td>
                <td>${cantidadProducto}</td>
                <td>${precioProducto}</td>
                <td>
                    ${parseFloat(cantidadProducto) * parseFloat(precioProducto)}
                    <input type="hidden" name="precio_detalle_compra[]" value="${parseFloat(cantidadProducto) * parseFloat(precioProducto)}" required></input>
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-danger" onclick="eliminarProducto(${idProducto}, ${parseFloat(cantidadProducto) * parseFloat(precioProducto)})">
                        Eliminar
                    </button>
                </td>
            </tr>
            `);
        let precioTotal = $("#total_compra").val() || 0;
        $("#total_compra").val(parseFloat(precioTotal) + (parseFloat(cantidadProducto) * parseFloat(precioProducto)));
    }
    else
    {
        swalA.fire(
            'Acción denegada',
            'Debes ingresar una cantidad y/o precio válidos.',
            'warning'
        )
    }
}

function eliminarProducto(idProducto, subtotalProducto)
{
    $("#producto-" + idProducto).remove();
    let precioTotal = $("input[id=total_compra]").val() || 0;
    $("input[id=total_compra]").val(parseFloat(precioTotal) - parseFloat(subtotalProducto));
}

// Modificar

function agregarCantidadEditar(cantidadProducto, precioProducto, idDetalle, idCompra)
{
    cantidadProducto = $("#cantidadDetalle" + idDetalle).text();
    nuevaCantidad = $("#cantidadDetalle" + idDetalle).text(parseInt(cantidadProducto) + parseInt(1));
    $("#precioDetalle" + idDetalle).text(parseFloat(precioProducto) * parseInt($("#cantidadDetalle" + idDetalle).text()));
    let precioTotal = $("input[id=total_compra_" + idCompra + "]").val() || 0;
    $("input[id=total_compra_" + idCompra + "]").val(parseFloat(precioTotal) + parseFloat(precioProducto));
    $("#cantidad_detalle_compra_" + idDetalle).val($("#cantidadDetalle" + idDetalle).text());
    $("#precio_detalle_compra_" + idDetalle).val($("#precioDetalle" + idDetalle).text());
}

function quitarCantidadEditar(cantidadProducto, precioProducto, idDetalle, idCompra)
{
    cantidadProducto = $("#cantidadDetalle" + idDetalle).text();
    if ((parseInt(cantidadProducto) - parseInt(1)) > 0)
    {
        $("#cantidadDetalle" + idDetalle).text(parseInt(cantidadProducto) - parseInt(1));
        $("#precioDetalle" + idDetalle).text(parseFloat(precioProducto) * parseInt($("#cantidadDetalle" + idDetalle).text()));
        let precioTotal = $("input[id=total_compra_" + idCompra + "]").val() || 0;
        $("input[id=total_compra_" + idCompra + "]").val(parseFloat(precioTotal) - parseFloat(precioProducto));
        $("#cantidad_detalle_compra_" + idDetalle).val($("#cantidadDetalle" + idDetalle).text());
        $("#precio_detalle_compra_" + idDetalle).val($("#precioDetalle" + idDetalle).text());
    }
    else 
    {
        swalA.fire(
            'Acción denegada',
            'Debes ingresar una cantidad válida.',
            'warning'
        )
    }
}

function eliminarProductoEditar(idDetalle, idCompra)
{
    let precioTotal = $("input[id=total_compra_" + idCompra + "]").val() || 0;
    $("input[id=total_compra_" + idCompra + "]").val(parseFloat(precioTotal) - parseFloat(Number($("#precioDetalle" + idDetalle).text())));
    $("#llave_detalle_compra_" + idDetalle).val("false");
    $("#productoEditar-" + idDetalle).hide();
}

// Agregar nuevos productos (modificar)

function agregarPrecioProductoDetalle(idCompra) 
{
    let precio = $("#producto_id_" + idCompra + " option:selected").attr("precio");
    $("#precio_producto_" + idCompra).val(precio);
    
}

function agregarProductoDetalle(idCompra)
{
    let idProducto = $("#producto_id_" + idCompra + " option:selected").val();
    let nombreProducto = $("#producto_id_" + idCompra + " option:selected").text();
    let cantidadProducto = $("#nueva_cantidad_detalle_compra_" + idCompra).val();
    let precioProducto = $("#precio_producto_" + idCompra).val();

    if (cantidadProducto > 0 && precioProducto > 0)
    {
        $('#tablaProductosEditar' + idCompra).append(`
            <tr id="nuevoProducto-${idProducto}">
                <td>
                    <input type="hidden" name="producto_id_${idCompra}[]" value="${idProducto}" required></input>
                    <input type="hidden" name="cantidad_detalle_compra_${idCompra}[]" value="${cantidadProducto}" required></input>
                    ${idProducto}
                </td>
                <td>${nombreProducto}</td>
                <td>${cantidadProducto}</td>
                <td>${precioProducto}</td>
                <td>
                    ${parseFloat(cantidadProducto) * parseFloat(precioProducto)}
                    <input type="hidden" name="precio_detalle_compra_${idCompra}[]" value="${parseFloat(cantidadProducto) * parseFloat(precioProducto)}" required></input>
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-danger" onclick="eliminarProductoDetalle(${idProducto}, ${parseFloat(cantidadProducto) * parseFloat(precioProducto)}, ${idCompra})">
                        Eliminar
                    </button>
                </td>
            </tr>
            `);
        let precioTotal = $("input[id=total_compra_" + idCompra + "]").val() || 0;
        $("input[id=total_compra_" + idCompra + "]").val(parseFloat(precioTotal) + (parseFloat(cantidadProducto) * parseFloat(precioProducto)));
        // $("#costo_adicional").val(parseFloat(cantidadProducto) * parseFloat(precioProducto));
    }
    else
    {
        swalA.fire(
            'Acción denegada',
            'Debes ingresar una cantidad y/o precio válidos.',
            'warning'
        )
    }
}

function eliminarProductoDetalle(idProducto, subtotalProducto, idCompra)
{
    $("#nuevoProducto-" + idProducto).remove();
    let precioTotal = $("input[id=total_compra_" + idCompra + "]").val() || 0;
    $("input[id=total_compra_" + idCompra + "]").val(parseFloat(precioTotal) - parseFloat(subtotalProducto));
}