<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'usuario' => 'admin',
            'email' => 'administrador@hotmail.com',
            'nombrecompleto' => 'ADMINISTRADOR',
            'password' => bcrypt('admin123'),
            'condicion' => true,
            'idrol' => 1
        ]);

        User::create([
            'usuario' => 'admin2',
            'email' => 'administrador2@hotmail.com',
            'nombrecompleto' => 'ADMINISTRADOR2',
            'password' => bcrypt('admin123'),
            'condicion' => true,
            'idrol' => 1
        ]);

        User::create([
            'usuario' => 'empleado',
            'email' => 'empleado@hotmail.com',
            'nombrecompleto' => 'EMPLEADO',
            'password' => bcrypt('admin123'),
            'condicion' => true,
            'idrol' => 2
        ]);

        User::create([
            'usuario' => 'cliente',
            'email' => 'cliente@hotmail.com',
            'nombrecompleto' => 'CLIENTE',
            'password' => bcrypt('admin123'),
            'condicion' => true,
            'idrol' => 3
        ]);
    }
}
