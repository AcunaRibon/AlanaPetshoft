<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\ShopController;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $fillable = ['id_producto', 'id_user'];

}
