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
            $table->string('descripcion',100);
            $table->integer('carrera_id')->unsigned();
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
