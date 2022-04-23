<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $table ='venta';
    protected $primaryKey = 'id_venta';
    protected $fillable =['fecha_venta','descuento_venta','calificacion_servicio_venta','cliente_id','domiciliario_documento','estado_venta_id'];
    public $timestamps = false;
}
