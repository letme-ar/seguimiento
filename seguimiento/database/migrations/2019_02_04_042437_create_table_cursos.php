<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCursos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('docente_id')->unsigned();
            $table->foreign('docente_id')->references('id')->on('docentes');

            $table->integer('materia_id')->unsigned();
            $table->foreign('materia_id')->references('id')->on('materias');

            $table->integer('dia_id')->unsigned();
            $table->foreign('dia_id')->references('id')->on('dias');


            $table->integer('horario_id')->unsigned();
            $table->foreign('horario_id')->references('id')->on('horarios');

            $table->integer('anio')->unsigned();

            $table->integer('ayudante_id')->unsigned()->nullable();
            $table->foreign('ayudante_id')->references('id')->on('docentes');

            $table->string('slug');
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
        Schema::dropIfExists('cursos');
    }
}
