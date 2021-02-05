<?php

use Illuminate\Database\Seeder;
use App\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categoria::create([
            'nombre' => 'TERROR',
            'descripcion' => 'Administrador del sistema'
        ]);

        Categoria::create([
            'nombre' => 'ROMANTICA',
            'descripcion' => 'Es un empleado de la tienda'
        ]);

        Categoria::create([
            'nombre' => 'INFANTIL',
            'descripcion' => 'EEs un cliente de la tienda'
        ]);

        Categoria::create([
            'nombre' => 'DOCUMENTAL',
            'descripcion' => 'Administrador del sistema'
        ]);

        Categoria::create([
            'nombre' => 'COMEDIAS',
            'descripcion' => 'Es un empleado de la tienda'
        ]);

        Categoria::create([
            'nombre' => 'MUSICALES',
            'descripcion' => 'EEs un cliente de la tienda'
        ]);

        Categoria::create([
            'nombre' => 'CIENCIA FICCION',
            'descripcion' => 'Administrador del sistema'
        ]);

        Categoria::create([
            'nombre' => 'BELICAS',
            'descripcion' => 'Es un empleado de la tienda'
        ]);

        Categoria::create([
            'nombre' => 'ACCION',
            'descripcion' => 'EEs un cliente de la tienda'
        ]);

        Categoria::create([
            'nombre' => 'SUSPENSO',
            'descripcion' => 'Administrador del sistema'
        ]);

        Categoria::create([
            'nombre' => 'AVENTURAS',
            'descripcion' => 'Es un empleado de la tienda'
        ]);

        Categoria::create([
            'nombre' => 'ADULTOS',
            'descripcion' => 'EEs un cliente de la tienda'
        ]);

        
    }
}
