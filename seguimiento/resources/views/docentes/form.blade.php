@extends('layouts.app')

@section('scripts')
    <script src="{{ asset('js/jquery.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#btnBack").click(function (){
                window.location.href = '/docentes';
            });
        });
    </script>
@endsection

@section('content')

    <form method="post" action="/docentes">
        @csrf
        <input type="hidden" name="id" value="{{ $docente->id or '' }}">
        <div class="card text-center">
            <div class="card-header">
                <h3>Cargar un docente</h3>
            </div>
            <div class="card-body">


                <div class="col-md-12 row">
                    <div class="col-md-6 form-group">
                        <label for="nombre" class="form-control-label">Nombre</label>
                        <input class="form-control" type="text" name="nombre" maxlength="100" value="{{ (old('nombre') != '') ? old('nombre') : $docente->nombre }}" autofocus required>
                        <div class="alert-danger">{!! $errors->first('nombre', ':message') !!}</div>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="apellido" class="form-control-label">Apellido</label>
                        <input class="form-control" type="text" name="apellido" maxlength="100" value="{{ (old('apellido') != '') ? old('apellido') : $docente->apellido }}" required>
                        <div class="alert-danger">{!! $errors->first('apellido', ':message') !!}</div>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="email" class="form-control-label">Correo electrónico</label>
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                            <input class="form-control" type="email" name="email" maxlength="50" value="{{ (old('email') != '') ? old('email') : $docente->email }}" required>
                        </div>
                        <div class="alert-danger">{!! $errors->first('email', ':message') !!}</div>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="dni" class="form-control-label">DNI</label>
                        <input class="form-control" type="number" name="dni" min="1000000" max="99999999" value="{{ (old('dni') != '') ? old('dni') : $docente->dni }}" required>
                        <div class="alert-danger">{!! $errors->first('dni', ':message') !!}</div>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="legajo" class="form-control-label">Legajo</label>
                        <input class="form-control" type="number" name="legajo" max="99999" value="{{ (old('legajo') != '') ? old('legajo') : $docente->legajo }}" required>
                        <div class="alert-danger">{!! $errors->first('legajo', ':message') !!}</div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted">
                <input type="button" id="btnBack" class="btn btn-danger" value="Volver">
                <input type="submit" class="btn btn-primary" value="Guardar">

            </div>
        </div>
    </form>

@endsection
