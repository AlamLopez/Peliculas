<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeliculasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peliculas', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->string('titulo')->unique();
            $table->string('director')->nullable();
            $table->integer('duracion')->nullable();
            $table->string('anio_estreno')->nullable();
            $table->double('multa_diaria')->nullable();
            $table->bigInteger('idcategoria')->unsigned();
            $table->boolean('condicion')->default(true);

            $table->foreign('idcategoria')->references('id')->on('categorias');
            
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
        Schema::dropIfExists('peliculas');
    }
}
