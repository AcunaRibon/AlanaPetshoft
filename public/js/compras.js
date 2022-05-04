// Registrar

function agregarPrecioProducto() 
{
    let precio = $("#producto_id option:selected").attr("precio");
    $("#precio_producto").val(precio);
    
}

let validar = false;

function agregarProducto()
{
    let idProducto = $("#producto_id option:selected").val();
    let nombreProducto = $("#producto_id option:selected").text();
    let cantidadProducto = $("#cantidad_detalle_compra").val();
    let precioProducto = $("#precio_producto").val();

    if (cantidadProducto > 0 && precioProducto > 0)
    {
        let validacion = true;

        if(validar == true)
        {
            var productos = new Array();
            var inputs = document.getElementsByClassName("producto_id"),
            inputsProductos = [].map.call(inputs, function(valores){
                productos.push(valores.value);
            });

            productos.forEach(function(valor){
                if(idProducto == valor)
                {
                    validacion = false;
                }
                console.log(valor);
            });
        }

        if(validacion == true)
        {
            $('#tablaProductos').append(`
            <tr id="producto-${idProducto}">
                <td>
                    <input type="hidden" class="producto_id" name="producto_id[]" value="${idProducto}" required></input>
                    <input type="hidden" name="cantidad_detalle_compra[]" value="${cantidadProducto}" required></input>
                    ${idProducto}
                </td>
                <td>${nombreProducto}</td>
                <td>
                    <div class="d-flex justify-content-between">
                        <p class="m-0" id="cantidadProducto${idProducto}">
                            ${cantidadProducto}
                        </p>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary btn-sm m-1 p-1" onclick="agregarCantidad(${cantidadProducto}, ${precioProducto}, ${idProducto})" title="Agregar un producto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                </svg>
                            </button>
                            <button type="button" class="btn btn-secondary btn-sm m-1 p-1" onclick="quitarCantidad(${cantidadProducto}, ${precioProducto}, ${idProducto})" title="Quitar un producto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                                    <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </td>
                <td>${precioProducto}</td>
                <td id="precioProducto${idProducto}">
                    ${parseFloat(cantidadProducto) * parseFloat(precioProducto)}
                    <input type="hidden" name="precio_detalle_compra[]" value="${parseFloat(cantidadProducto) * parseFloat(precioProducto)}" required></input>
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-danger" onclick="eliminarProducto(${idProducto}, ${parseFloat(cantidadProducto) * parseFloat(precioProducto)})" title="Quitar producto">
                        Eliminar
                    </button>
                </td>
            </tr>
            `);
            let precioTotal = $("#total_compra").val() || 0;
            $("#total_compra").val(parseFloat(precioTotal) + (parseFloat(cantidadProducto) * parseFloat(precioProducto)));
            validar = true;
        }
        else
        {
            swalA.fire(
                'Acción denegada',
                'Producto ya ingresado, si deseas modificarlo, busca el producto en la lista para hacer cambios.',
                'warning'
            )
        }
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

function agregarCantidad(cantidadProducto, precioProducto, idProducto)
{
    cantidadProducto = $("#cantidadProducto" + idProducto).text();
    nuevaCantidad = $("#cantidadProducto" + idProducto).text(parseInt(cantidadProducto) + parseInt(1));
    $("#precioProducto" + idProducto).text(parseFloat(precioProducto) * parseInt($("#cantidadProducto" + idProducto).text()));
    let precioTotal = $("input[id=total_compra]").val() || 0;
    $("input[id=total_compra]").val(parseFloat(precioTotal) + parseFloat(precioProducto));
}

function quitarCantidad(cantidadProducto, precioProducto, idProducto)
{
    cantidadProducto = $("#cantidadProducto" + idProducto).text();
    if ((parseInt(cantidadProducto) - parseInt(1)) > 0)
    {
        $("#cantidadProducto" + idProducto).text(parseInt(cantidadProducto) - parseInt(1));
        $("#precioProducto" + idProducto).text(parseFloat(precioProducto) * parseInt($("#cantidadProducto" + idProducto).text()));
        let precioTotal = $("input[id=total_compra]").val() || 0;
        $("input[id=total_compra]").val(parseFloat(precioTotal) - parseFloat(precioProducto));
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
        let validacion = true;

        var productos = new Array();
        var inputs = document.getElementsByClassName("producto_id_detalle"),
        inputsProductos = [].map.call(inputs, function(valores){
            productos.push(valores.value);
        });

        productos.forEach(function(valor){
            if(idProducto == valor)
            {
                validacion = false;
            }
            console.log(valor);
        });

        if(validacion == true)
        {
            $('#tablaProductosEditar' + idCompra).append(`
                <tr id="nuevoProducto-${idProducto}">
                    <td>
                        <input type="hidden" class="producto_id_detalle" name="producto_id_${idCompra}[]" value="${idProducto}" required></input>
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
                        <button type="button" class="btn btn-danger" onclick="eliminarProductoDetalle(${idProducto}, ${parseFloat(cantidadProducto) * parseFloat(precioProducto)}, ${idCompra})" title="Quitar producto">
                            Eliminar
                        </button>
                    </td>
                </tr>
            `);
            let precioTotal = $("input[id=total_compra_" + idCompra + "]").val() || 0;
            $("input[id=total_compra_" + idCompra + "]").val(parseFloat(precioTotal) + (parseFloat(cantidadProducto) * parseFloat(precioProducto)));
        }
        else
        {
            swalA.fire(
                'Acción denegada',
                'Producto ya ingresado, si deseas modificarlo, busca el producto en las listas para hacer cambios.',
                'warning'
            )
        }
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