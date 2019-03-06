@extends('layouts.app')

@section('scripts')

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script>

        $(document).ready(function () {

            $('select[name=ayudante_id]').selectpicker();

            // $("#btnBack").click(function (){
            //     window.location.href = '/cursos';
            // });


        });

    </script>

@endsection

@section('content')

    @if(isset($curso))
        <form method="post" action="/cursos/{{ $curso->id }}/update" id="cursos">
        <h1>Editar un curso</h1>
    @else
        <form method="post" action="/cursos" id="cursos">
        <h1>Crear un curso</h1>
    @endif

    @csrf
        <div class="row">

            @include('components.select-template',[
                'description' => 'Carrera',
                'name' => 'carrera_id',
                'selected' => old('carrera_id') || isset($curso) ? $curso->materia->carrera->id : null,
                'options' => ['' => 'Seleccione una carrera'] + $carreras,
                'error' => $errors->first('carrera_id', ':message'),
                'attributes' => '@change=traerMaterias() v-model=carrera_id'
            ])

            <div class="col form-group">
                <label for="materia_id">Materia</label>
                <select name="materia_id" class="form-control">
                    <option value="">Seleccione una materia</option>
                    <option id="materia_id"
                            v-for="materia in materias"
                            :selected="materia_selected == materia.id"
                            :value="materia.id">
                            @{{ materia.descripcion }}
                    </option>
                </select>
                <div class="alert-danger">{!! $errors->first('materia_id', ':message') !!}</div>

            </div>

        </div>

        <div class="row">

            @include('components.select-template',[
                'description' => 'Dia',
                'name' => 'dia_id',
                'selected' => isset($curso) ? $curso->dia_id : null,
                'options' => ['' => 'Seleccione un dia'] + $dias,
                'error' => $errors->first('dia_id', ':message')
            ])

            @include('components.select-template',[
                'description' => 'Horario',
                'name' => 'horario_id',
                'selected' => isset($curso) ? $curso->horario_id : null,
                'options' => ['' => 'Seleccione un horario'] + $horarios,
                'error' => $errors->first('horario_id', ':message')
            ])

        </div>
        <div class="row">
            @include('components.select-template',[
                'description' => 'Año',
                'name' => 'anio',
                'selected' => isset($curso) ? $curso->anio : null,
                'options' => ['' => 'Seleccione un año'] + $anios,
                'error' => $errors->first('anio', ':message')
            ])

            @include('components.select-template',[
                'description' => 'Ayudante',
                'name' => 'ayudante_id',
                'selected' => isset($curso) ? $curso->ayudante_id : null,
                'options' => ['' => 'Seleccione un ayudante'] + $ayudantes,
                'error' => $errors->first('ayudante_id', ':message'),
                'class' => 'selectpicker',
                'attributes' => 'data-live-search="true"'
            ])

        </div>

        @include('components.botones')

    </form>
    <script>


        var app = new Vue({
            el: '#cursos',
            data: {
                carrera_id: "{!! old('carrera_id', ($curso->materia->carrera_id) ?? '') !!}",
                materia_actual_id: "{!! ($curso->materia_id) ?? '' !!}",
                materia_selected: "{!! old('carrera_id', ($curso->materia_id) ?? '') !!}",
                materias: []
            },
            methods: {
                traerMaterias: function () {
                    let theVue = this;
                    axios.post('/materias/'+theVue.carrera_id+'/'+theVue.materia_actual_id).
                        then((response) => (theVue.materias = response.data))
                },
                volver: function(){
                    window.location.href = '/cursos';
                }
            },
            created: function(){
                if("{{ isset($curso) }}")
                    this.traerMaterias()
            }
        })

    </script>


@endsection
