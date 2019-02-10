@extends('layouts.app')

@section('content')

        <div class="card text-center">
            <div class="card-header">
                <h3>Docente {{ $docente->FullName }}</h3>
            </div>
            <div class="card-body">


                <div class="col-md-12 row">
                    <div class="col-md-6 form-group">
                        <label for="nombre" class="form-control-label">Nombre: {{ $docente->nombre }}</label>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="nombre" class="form-control-label">Apellido: {{ $docente->apellido }}</label>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="nombre" class="form-control-label">Correo electrónico: {{ $docente->mail }}</label>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="nombre" class="form-control-label">DNI: {{ $docente->dni }}</label>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="nombre" class="form-control-label">Legajo: {{ $docente->legajo }}</label>
                    </div>
                </div>
            </div>
        </div>

@endsection
