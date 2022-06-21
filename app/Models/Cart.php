<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory; 
    public $table="carts";
    protected $primaryKey = 'id';
    protected $fillable =['id_producto','id_user','quantity'];
    public $timestamps = false;
    
}
