@extends('layouts.app')


@section('content')

<h1>Listado de cursos</h1>

<a href="{{ route('cursos.create') }}" class="btn btn-primary">Cargar nuevo curso</a>

@endsection
