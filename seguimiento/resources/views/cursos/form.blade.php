@extends('layouts.app')



@section('content')

    @foreach($errors->all() as $error)

        {!! $error !!}

    @endforeach

    @if(isset($curso))
        <form method="post" action="/cursos/{{ $curso->id }}/update">
    @else
        <form method="post" action="/cursos">
    @endif

    @csrf

    <h1>Crear un curso</h1>

    <div class="row">
        <div class="col form-group">
            <label for="carrera_id">Carrera</label>
            <select class="form-control" id="carrera_id">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
            <div class="alert-danger">{!! $errors->first('carrera_id', ':message') !!}</div>
        </div>
        <div class="col form-group">
            <label for="materia_id">Materia</label>
            <select class="form-control" id="materia_id" name="materia_id">
                <option></option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
            <div class="alert-danger">{!! $errors->first('materia_id', ':message') !!}</div>
        </div>
    </div>
    <div class="row">
        <div class="col form-group">
            <label for="dia">Dia</label>
            <select class="form-control" id="dia_id" name="dia_id">
                <option></option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
            <div class="alert-danger">{!! $errors->first('dia_id', ':message') !!}</div>
        </div>
        <div class="col form-group">
            <label for="horario">Horario</label>
            <select class="form-control" id="horario_id" name="horario_id">
                <option></option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
            <div class="alert-danger">{!! $errors->first('horario_id', ':message') !!}</div>
        </div>
    </div>
    <div class="row">
        <div class="col form-group">
            <label for="anio">Año</label>
            <select class="form-control" id="anio" name="anio">
                <option></option>
                <option>2018</option>
                <option>2019</option>
                <option>2020</option>
            </select>
            <div class="alert-danger">{!! $errors->first('anio', ':message') !!}</div>
        </div>
        <div class="col form-group">
            <label for="ayudante_id">Ayudante</label>
            <select class="form-control" id="ayudante_id" name="ayudante_id">
                <option></option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
            <div class="alert-danger">{!! $errors->first('ayudante_id', ':message') !!}</div>
        </div>
    </div>
            <input type="submit" value="Guardar">
        </form>

@endsection
