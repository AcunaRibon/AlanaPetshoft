<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalificacionProducto extends Model
{
    use HasFactory;

    protected $table ='calificacion_producto';
    protected $primaryKey = 'id_calificacion_producto';
    protected $fillable =['valor_calificacion_producto','producto_id'];
    public $timestamps = false;
}
