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
            'email' => 'administrador@ues.edu.com',
            'nombrecompleto' => 'ADMINISTRADOR',
            'password' => bcrypt('admin123'),
            'condicion' => true,
            'idrol' => 1
        ]);
    }
}
