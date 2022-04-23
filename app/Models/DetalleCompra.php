<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
    use HasFactory;

    protected $table = 'detalle_compra';
    protected $primaryKey = 'id_detalle_compra';
    protected $fillable = ['cantidad_detalle_compra', 'precio_detalle_compra', 'compra_id', 'producto_id'];
    public $timestamps = false;
}
