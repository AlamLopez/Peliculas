<?php

use Illuminate\Database\Seeder;
use App\Rol;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Rol::create([
            'nombre' => 'ADMINISTRADOR',
            'descripcion' => 'Administrador del sistema'
        ]);

        Rol::create([
            'nombre' => 'EMPLEADO',
            'descripcion' => 'Es un empleado de la tienda'
        ]);

        Rol::create([
            'nombre' => 'CLIENTE',
            'descripcion' => 'EEs un cliente de la tienda'
        ]);
    }
}
