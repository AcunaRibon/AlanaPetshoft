 function colocar_precio(e){
    let precio =$("#producto_id"+e+" option:selected").attr("precio");
    $("#precio_detalle_venta"+e).val(precio);

 
    
    
}


function agregar_producto(k){
    let producto_id =$("#producto_id"+k+" option:selected").val();
    let producto_nom =$("#producto_id"+k+" option:selected").text();
    let cantidad =$("#cantidad_detalle_venta"+k).val();
    let precio =$("#precio_detalle_venta"+k).val();

    if(cantidad > 0 && precio > 0){

        let resume_table = document.getElementById("tablaP"+k);
        let e= true;
        for (let i = 0, row; row = resume_table.rows[i]; i++) {
          //alert(cell[i].innerText);
           col = row.cells[0]
            //alert(col[j].innerText);
            if(producto_id==col.innerText){
                e=false;
                
                
            }
            
          
        }
    
        if(e==true){
            $('#tablaPP'+k).append( `


                <tr id="tr${k}_${producto_id}">
                    <td>
                    <input type="hidden" name="productos_id[]" value="${producto_id}"/>
                    <input type="hidden" name="cantidades[]" value="${cantidad}"/>
    
                    ${producto_id}
                    </td>
                    <td>
                    ${producto_nom}
                    </td>
                    <td id="cd${k}_${producto_id}">${cantidad}</td>
                    <td>${precio}</td>
                    <td id="st${k}_${producto_id}">${parseInt(cantidad) * parseInt(precio)}</td>
                    <td>
                    <button type="button" class="btn btn-danger" onclick="eliminar_producto(${producto_id},${parseInt(cantidad) * parseInt(precio)},${k})">
                    x
                    </button>
                    </td>
                    
    
                </tr>
            `);
            let total = $("#total_venta"+k).val() || 0;
            $("#total_venta"+k).val(parseInt(total)+ parseInt(cantidad) * parseInt(precio));

           
        }else{
            console.log("HP2");
            let st =parseInt(cantidad) * parseInt(precio);
                let total = $("#total_venta"+k).val() || 0;
                $("#total_venta"+k).val((parseInt(total)-parseInt(document.getElementById('st'+k+'_'+producto_id).innerHTML))+ st);
    
                $("#cantidadDetalle"+k+"_"+producto_id).val(cantidad);
                
            document.getElementById('cd'+k+'_'+producto_id).innerHTML=cantidad;
            document.getElementById('st'+k+'_'+producto_id).innerHTML=st;
            
            
        }
       
    
       
    }
}

function eliminar_producto(id, subtot,e){
    $("#tr"+e+"_"+id).remove();
    
    let total = $("#total_venta"+e).val() || 0;
    $("#total_venta"+e).val(parseInt(total)- subtot);
}