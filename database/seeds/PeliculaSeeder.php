<?php

use Illuminate\Database\Seeder;
use App\Pelicula;

class PeliculaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Pelicula::create([
            'titulo' => 'LA FORMA DEL AGUA',
            'director' => 'GUILLERMO DEL TORO',
            'duracion' => 120,
            'anio_estreno' => '2017',
            'multa_diaria' => 4.95,
            'condicion' => true,
            'idcategoria' => 2
        ]);

        Pelicula::create([
            'titulo' => 'EL RENACIDO',
            'director' => 'ALEJANDRO GONZALEZ INIARRITU',
            'duracion' => 156,
            'anio_estreno' => '2015',
            'multa_diaria' => 2.60,
            'condicion' => true,
            'idcategoria' => 10
        ]);

        Pelicula::create([
            'titulo' => 'BIRDMAN',
            'director' => 'ALEJANDRO GONZALEZ INIARRITU',
            'duracion' => 140,
            'anio_estreno' => '2017',
            'multa_diaria' => 3.95,
            'condicion' => true,
            'idcategoria' => 10
        ]);

        Pelicula::create([
            'titulo' => 'ERASE UNA VEZ EN HOLLYWOOD',
            'director' => 'QUENTIN TARANTINO',
            'duracion' => 150,
            'anio_estreno' => '2019',
            'multa_diaria' => 1.95,
            'condicion' => true,
            'idcategoria' => 5
        ]);
    }
}
