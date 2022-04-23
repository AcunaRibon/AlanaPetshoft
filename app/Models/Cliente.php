<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Cliente extends Model
{
    use HasFactory;

    protected $table='cliente';
 protected $primaryKey ='id_cliente';

 protected $fillable =['nombres_cliente','apellidos_cliente', 'correo_electronico_cliente','celular_cliente','direccion_cliente','estado_cliente'];
 public $timestamps = false;
}
