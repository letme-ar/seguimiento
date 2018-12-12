<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMaterias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materias',function(Blueprint $table){
            $table->increments('id');
            $table->integer('carrera_id')->unsigned();
            $table->string('descripcion',100);
            $table->smallInteger('horas_semanales')->unisgned();
            $table->smallInteger('cuatrimestre')->unisgned();
            $table->smallInteger('anio')->unisgned();
            $table->smallInteger('horas_cuatrimestrales')->unisgned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('carrera_id')->references('id')->on('carreras');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::dropForeign('materias_carrera_id_foreign');
        Schema::dropIfExists('materias');
    }
}
