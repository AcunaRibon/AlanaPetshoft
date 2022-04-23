<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'producto';
    protected $primaryKey = 'id_producto';
    protected $fillable = ['nombre_producto', 'existencia_producto', 'precio_producto', 'estado_producto', 'tipo_producto_id'];
    public $timestamps = false;
}
