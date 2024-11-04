<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sells extends Model
{
    //use HasFactory;
    public $incrementing = false; // Deshabilita el autoincremento
    protected $primaryKey = ['idVenta', 'idProducto']; // Define la clave primaria compuesta
    protected $table = 'sells'; // Asegúra de que el nombre de la tabla es correcto

    protected $fillable = ['idVenta', 'idProducto', 'nombreProducto', 'cantidad', 'precioTotal'];
}
