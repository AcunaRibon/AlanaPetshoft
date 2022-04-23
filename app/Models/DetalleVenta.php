<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;

    protected $table ='detalle_venta';
    protected $primaryKey = 'id_detalle_venta';
    protected $fillable =['cantidad_detalle_venta','precio_detalle_venta','venta_id','producto_id'];
    public $timestamps = false;
}
