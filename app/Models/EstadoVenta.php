<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoVenta extends Model
{
    use HasFactory;
    protected $table = 'estado_venta';
    protected $primaryKey = 'id_estado_venta';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['id_estado_venta','nombre_estado_venta'];
    public $timestamps = false;
}