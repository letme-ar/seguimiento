<?php

use App\Models\Materia;
use Illuminate\Database\Seeder;

class MateriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Materia::create([
           'carrera_id' => 1,
           'descripcion' => 'Programación I',
           'abreviatura' => 'PROG1',
           'horas_semanales' => 6,
           'cuatrimestre' => 1,
           'anio' => 1,
           'horas_cuatrimestrales' => 96,
        ]);
        Materia::create([
           'carrera_id' => 1,
           'descripcion' => 'Sistema de Procesamiento de Datos',
           'abreviatura' => 'SPD',
           'horas_semanales' => 6,
           'cuatrimestre' => 1,
           'anio' => 1,
           'horas_cuatrimestrales' => 96,
        ]);
        Materia::create([
           'carrera_id' => 1,
           'descripcion' => 'Matemática',
           'abreviatura' => 'MAT',
           'horas_semanales' => 9,
           'cuatrimestre' => 1,
           'anio' => 1,
           'horas_cuatrimestrales' => 144,
        ]);
        Materia::create([
           'carrera_id' => 1,
           'descripcion' => 'Ingles I',
           'abreviatura' => 'INGL1',
           'horas_semanales' => 3,
           'cuatrimestre' => 1,
           'anio' => 1,
           'horas_cuatrimestrales' => 48,
        ]);
        Materia::create([
           'carrera_id' => 1,
           'descripcion' => 'Laboratorio de Computación I',
           'abreviatura' => 'LAB1',
           'horas_semanales' => 6,
           'cuatrimestre' => 1,
           'anio' => 1,
           'horas_cuatrimestrales' => 96,
        ]);
        Materia::create([
           'carrera_id' => 1,
           'descripcion' => 'Programación II',
           'abreviatura' => 'PROG2',
           'horas_semanales' => 6,
           'cuatrimestre' => 2,
           'anio' => 1,
           'horas_cuatrimestrales' => 96,
        ]);
        Materia::create([
           'carrera_id' => 1,
           'descripcion' => 'Arquitectura y Sistemas Operativos',
           'abreviatura' => 'AYSO',
           'horas_semanales' => 6,
           'cuatrimestre' => 2,
           'anio' => 1,
           'horas_cuatrimestrales' => 96,
        ]);
        Materia::create([
           'carrera_id' => 1,
           'descripcion' => 'Estadistica',
           'abreviatura' => 'EST',
           'horas_semanales' => 6,
           'cuatrimestre' => 2,
           'anio' => 1,
           'horas_cuatrimestrales' => 96,
        ]);
        Materia::create([
           'carrera_id' => 1,
           'descripcion' => 'Ingles II',
           'abreviatura' => 'INGL2',
           'horas_semanales' => 3,
           'cuatrimestre' => 2,
           'anio' => 1,
           'horas_cuatrimestrales' => 48,
        ]);
        Materia::create([
           'carrera_id' => 1,
           'descripcion' => 'Laboratorio de Computación II',
           'abreviatura' => 'LAB2',
           'horas_semanales' => 6,
           'cuatrimestre' => 2,
           'anio' => 1,
           'horas_cuatrimestrales' => 96,
        ]);
        Materia::create([
           'carrera_id' => 1,
           'descripcion' => 'Metodología de la Investigación',
           'abreviatura' => 'METINV',
           'horas_semanales' => 3,
           'cuatrimestre' => 2,
           'anio' => 1,
           'horas_cuatrimestrales' => 48,
        ]);
        Materia::create([
           'carrera_id' => 1,
           'descripcion' => 'Programación III',
           'abreviatura' => 'PROG3',
           'horas_semanales' => 6,
           'cuatrimestre' => 1,
           'anio' => 2,
           'horas_cuatrimestrales' => 96,
        ]);
        Materia::create([
           'carrera_id' => 1,
           'descripcion' => 'Organización Contable de la Empresa',
           'abreviatura' => 'CONT',
           'horas_semanales' => 6,
           'cuatrimestre' => 1,
           'anio' => 2,
           'horas_cuatrimestrales' => 96,
        ]);
        Materia::create([
           'carrera_id' => 1,
           'descripcion' => 'Organización Empresarial',
           'abreviatura' => 'ORGEMP',
           'horas_semanales' => 6,
           'cuatrimestre' => 1,
           'anio' => 2,
           'horas_cuatrimestrales' => 96,
        ]);
        Materia::create([
           'carrera_id' => 1,
           'descripcion' => 'Elementos de Investigación Operativa',
           'abreviatura' => 'ELEM',
           'horas_semanales' => 6,
           'cuatrimestre' => 1,
           'anio' => 2,
           'horas_cuatrimestrales' => 96,
        ]);
        Materia::create([
           'carrera_id' => 1,
           'descripcion' => 'Laboratorio de Computación III',
           'abreviatura' => 'LAB3',
           'horas_semanales' => 6,
           'cuatrimestre' => 1,
           'anio' => 2,
           'horas_cuatrimestrales' => 96,
        ]);
        Materia::create([
           'carrera_id' => 1,
           'descripcion' => 'Metodología de Sistemas I',
           'abreviatura' => 'METSISI',
           'horas_semanales' => 12,
           'cuatrimestre' => 2,
           'anio' => 2,
           'horas_cuatrimestrales' => 192,
        ]);
        Materia::create([
           'carrera_id' => 1,
           'descripcion' => 'Diseño y Administración de Bases de Datos',
           'abreviatura' => 'DADB',
           'horas_semanales' => 6,
           'cuatrimestre' => 2,
           'anio' => 2,
           'horas_cuatrimestrales' => 96,
        ]);
        Materia::create([
           'carrera_id' => 1,
           'descripcion' => 'Legislación',
           'abreviatura' => 'LEG',
           'horas_semanales' => 6,
           'cuatrimestre' => 2,
           'anio' => 2,
           'horas_cuatrimestrales' => 96,
        ]);
        Materia::create([
           'carrera_id' => 1,
           'descripcion' => 'Laboratorio de Computación IV',
           'abreviatura' => 'LAB4',
           'horas_semanales' => 6,
           'cuatrimestre' => 2,
           'anio' => 2,
           'horas_cuatrimestrales' => 96,
        ]);
        Materia::create([
           'carrera_id' => 1,
           'descripcion' => 'Práctica Profesional',
           'abreviatura' => 'PPS',
           'horas_semanales' => 0,
           'cuatrimestre' => 2,
           'anio' => 2,
           'horas_cuatrimestrales' => 60,
        ]);

        Materia::create([
           'carrera_id' => 2,
           'descripcion' => 'Matemática II',
           'abreviatura' => 'MAT2',
           'horas_semanales' => 3,
           'cuatrimestre' => 1,
           'anio' => 1,
           'horas_cuatrimestrales' => 48,
        ]);
        Materia::create([
           'carrera_id' => 2,
           'descripcion' => 'Inglés Técnico Avanzado I',
           'abreviatura' => 'INGLT1',
           'horas_semanales' => 3,
           'cuatrimestre' => 1,
           'anio' => 1,
           'horas_cuatrimestrales' => 48,
        ]);
        Materia::create([
           'carrera_id' => 2,
           'descripcion' => 'Base de Datos II',
           'abreviatura' => 'DB2',
           'horas_semanales' => 6,
           'cuatrimestre' => 1,
           'anio' => 1,
           'horas_cuatrimestrales' => 96,
        ]);
        Materia::create([
           'carrera_id' => 2,
           'descripcion' => 'Programación Avanzada I',
            'abreviatura' => 'PROGAVI',
           'horas_semanales' => 6,
           'cuatrimestre' => 1,
           'anio' => 1,
           'horas_cuatrimestrales' => 96,
        ]);
        Materia::create([
           'carrera_id' => 2,
           'descripcion' => 'Laboratorio V',
           'abreviatura' => 'LAB5',
           'horas_semanales' => 6,
           'cuatrimestre' => 1,
           'anio' => 1,
           'horas_cuatrimestrales' => 96,
        ]);
        Materia::create([
           'carrera_id' => 2,
           'descripcion' => 'Metodología de Sistemas II',
           'abreviatura' => 'METSIS2',
           'horas_semanales' => 6,
           'cuatrimestre' => 1,
           'anio' => 1,
           'horas_cuatrimestrales' => 96,
        ]);
        Materia::create([
           'carrera_id' => 2,
           'descripcion' => 'Redes',
           'abreviatura' => 'REDES',
           'horas_semanales' => 6,
           'cuatrimestre' => 1,
           'anio' => 1,
           'horas_cuatrimestrales' => 96,
        ]);
        Materia::create([
           'carrera_id' => 2,
           'descripcion' => 'Matemática III',
           'abreviatura' => 'MAT3',
           'horas_semanales' => 6,
           'cuatrimestre' => 2,
           'anio' => 1,
           'horas_cuatrimestrales' => 96,
        ]);
        Materia::create([
           'carrera_id' => 2,
           'descripcion' => 'Inglés Técnico Avanzado II',
           'abreviatura' => 'INGLT2',
           'horas_semanales' => 3,
           'cuatrimestre' => 2,
           'anio' => 1,
           'horas_cuatrimestrales' => 48,
        ]);
        Materia::create([
           'carrera_id' => 2,
           'descripcion' => 'Investigación Operativa II',
           'abreviatura' => 'INVOPE2',
           'horas_semanales' => 3,
           'cuatrimestre' => 2,
           'anio' => 1,
           'horas_cuatrimestrales' => 48,
        ]);
        Materia::create([
           'carrera_id' => 2,
           'descripcion' => 'Programación Avanzada II',
           'abreviatura' => 'PROGAV2',
           'horas_semanales' => 6,
           'cuatrimestre' => 2,
           'anio' => 1,
           'horas_cuatrimestrales' => 96,
        ]);
        Materia::create([
           'carrera_id' => 2,
           'descripcion' => 'Metodología de Sistemas III',
           'abreviatura' => 'METSIS3',
           'horas_semanales' => 6,
           'cuatrimestre' => 2,
           'anio' => 1,
           'horas_cuatrimestrales' => 96,
        ]);
        Materia::create([
           'carrera_id' => 2,
           'descripcion' => 'Administración y Dirección de Proyectos',
           'abreviatura' => 'ADPROY',
           'horas_semanales' => 6,
           'cuatrimestre' => 2,
           'anio' => 1,
           'horas_cuatrimestrales' => 96,
        ]);
        Materia::create([
           'carrera_id' => 2,
           'descripcion' => 'Seminario',
           'abreviatura' => 'SEM',
           'horas_semanales' => 6,
           'cuatrimestre' => 2,
           'anio' => 1,
           'horas_cuatrimestrales' => 96,
        ]);
        Materia::create([
           'carrera_id' => 2,
           'descripcion' => 'Práctica Profesional',
           'abreviatura' => 'PPS2',
           'horas_semanales' => 0,
           'cuatrimestre' => 0,
           'anio' => 1,
           'horas_cuatrimestrales' => 60,
        ]);

    }
}
