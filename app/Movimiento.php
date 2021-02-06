<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    //
    protected $table = 'movimientos';

    protected $primaryKey = 'id';

    protected $fillable = [
        'idpelicula', 
        'iduser', 
        'movimiento',
        'fecha'
    ];

}
