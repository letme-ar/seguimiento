@extends('layouts.app')

@section('content')

    <form method="post" action="/docentes">
        @csrf
        <div class="card text-center">
            <div class="card-header">
                <h3>Cargar un docente</h3>
            </div>
            <div class="card-body">

                <div class="col-md-12 row">
                    <div class="col-md-6 form-group">
                        <label for="nombre" class="form-control-label">Nombre</label>
                        <input class="form-control" type="text" name="nombre" value="{{ old('nombre') }}" autofocus>
                        <div class="alert-danger">{!! $errors->first('nombre', ':message') !!}</div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="apellido" class="form-control-label">Apellido</label>
                        <input class="form-control" type="text" name="apellido" value="{{ old('apellido') }}">
                        <div class="alert-danger">{!! $errors->first('apellido', ':message') !!}</div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="email" class="form-control-label">Correo electrónico</label>
                        <input class="form-control" type="email" name="email" value="{{ old('email') }}">
                        <div class="alert-danger">{!! $errors->first('email', ':message') !!}</div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="dni" class="form-control-label">DNI</label>
                        <input class="form-control" type="text" name="dni" value="{{ old('dni') }}">
                        <div class="alert-danger">{!! $errors->first('dni', ':message') !!}</div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="legajo" class="form-control-label">Legajo</label>
                        <input class="form-control" type="text" name="legajo" value="{{ old('legajo') }}">
                        <div class="alert-danger">{!! $errors->first('legajo', ':message') !!}</div>
                    </div>
                </div>
                {{--@if ($errors->any())--}}
                    {{--<div class="alert alert-danger col-md-4">--}}
                        {{--<ul>--}}
                            {{--@foreach ($errors->all() as $error)--}}
                                {{--<li>{{ $error }}</li>--}}
                            {{--@endforeach--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                {{--@endif--}}
            </div>
            <div class="card-footer text-muted">
                <button class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </form>

@endsection
