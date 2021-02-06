<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
    //
    protected $table = 'peliculas';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre', 
        'director',
        'duracion',
        'anio_estreno',
        'multa_diaria',
        'idcategoria', 
        'condicion'
    ];
}
