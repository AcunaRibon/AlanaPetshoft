<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domiciliario extends Model
{
    use HasFactory;

    protected $table = 'domiciliario';
    protected $primaryKey = 'documento_domiciliario';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['nombres_domiciliario', 'apellidos_domiciliario', 'celular_domiciliario', 'estado_domiciliario'];
    public $timestamps = false;
}
