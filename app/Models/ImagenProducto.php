<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagenProducto extends Model
{
    use HasFactory;

    protected $table ='imagen_producto';
    protected $primaryKey = 'id_imagen_producto';
    protected $fillable =['url_imagen_producto','producto_id'];
    public $timestamps = false;
}
