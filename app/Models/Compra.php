<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $table = 'compra';
    protected $primaryKey = 'id_compra';
    protected $fillable = ['total_compra', 'fecha_pedido_compra', 'fecha_entrega_compra', 'estado_pedido_compra', 'proveedor_id'];
    public $timestamps = false;
}
