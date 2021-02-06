<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientos', function (Blueprint $table) {
            
            $table->bigIncrements('id');

            $table->bigInteger('idpelicula')->unsigned();
            $table->bigInteger('iduser')->unsigned();
            $table->string('movimiento');
            $table->date('fecha');

            $table->foreign('idpelicula')->references('id')->on('peliculas');
            $table->foreign('iduser')->references('id')->on('users');
            
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movimientos');
    }
}
