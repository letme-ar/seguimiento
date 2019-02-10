@extends('layouts.app')



@section('content')


    @if(isset($curso))
        <form method="post" action="/cursos/update">
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
        </div>
        <div class="col form-group">
            <label for="materia_id">Materia</label>
            <select class="form-control" id="materia_id">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col form-group">
            <label for="dia">Dia</label>
            <select class="form-control" id="dia">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </div>
        <div class="col form-group">
            <label for="horario">Horario</label>
            <select class="form-control" id="horario">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col form-group">
            <label for="anio">Año</label>
            <select class="form-control" id="anio">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </div>
        <div class="col form-group">
            <label for="ayudante_id">Ayudante</label>
            <select class="form-control" id="ayudante_id">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </div>
    </div>


@endsection
