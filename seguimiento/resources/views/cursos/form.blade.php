@extends('layouts.app')

@section('scripts')

    <script>

        $(document).ready(function () {

            $('select[name=ayudante_id]').selectpicker();

            $("#btnBack").click(function (){
                window.location.href = '/cursos';
            });


        });


    </script>

@endsection

@section('content')

    @if(isset($curso))
    <form method="post" action="/cursos/{{ $curso->id }}/update">
    @else
    <form method="post" action="/cursos">
    @endif

    @csrf

        <h1>Crear un curso</h1>

            <div class="row">

                @include('components.select-template',[
                    'description' => 'Carrera',
                    'name' => 'carrera_id',
                    'options' => ['' => 'Seleccione una carrera'] + $carreras,
                    'error' => $errors->first('carrera_id', ':message')
                ])

                @include('components.select-template',[
                    'description' => 'Materia',
                    'name' => 'materia_id',
                    'options' => ['' => 'Seleccione una materia'] + $materias,
                    'error' => $errors->first('materia_id', ':message'),
                    'attributes' => 'data-live-search="true"'
                ])

            </div>

            <div class="row">

                @include('components.select-template',[
                    'description' => 'Dia',
                    'name' => 'dia_id',
                    'options' => ['' => 'Seleccione un dia'] + $dias,
                    'error' => $errors->first('dia_id', ':message')
                ])

                @include('components.select-template',[
                    'description' => 'Horario',
                    'name' => 'horario_id',
                    'options' => ['' => 'Seleccione un horario'] + $horarios,
                    'error' => $errors->first('horario_id', ':message')
                ])

            </div>
            <div class="row">
                @include('components.select-template',[
                    'description' => 'Año',
                    'name' => 'anio',
                    'options' => ['' => 'Seleccione un año'] + $anios,
                    'error' => $errors->first('anio', ':message')
                ])

                @include('components.select-template',[
                    'description' => 'Ayudante',
                    'name' => 'ayudante_id',
                    'options' => ['' => 'Seleccione un ayudante'] + $ayudantes,
                    'error' => $errors->first('ayudante_id', ':message'),
                    'attributes' => 'data-live-search="true"'
                ])

            </div>
        <div class="text-center">
            <div class="card-footer text-muted">
                <input type="button" id="btnBack" class="btn btn-danger" value="Volver">
                <input type="submit" value="Guardar" class="btn btn-primary">
            </div>
        </div>
    </form>

@endsection
