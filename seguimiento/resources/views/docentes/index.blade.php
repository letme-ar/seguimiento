@extends('layouts.app')

@section('content')
    @include('components.message-confirmation')
    <a href="{!! route('docentes.create')!!}"><button class="btn btn-success pull-right">Agregar</button></a>

    <table class="table table-hover table-sm" style="margin-top: 10px">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Email</th>
            <th scope="col">DNI</th>
            <th scope="col">Legajo</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
            @forelse($docentes as $docente)
            <tr>
                <td>{{ $docente->nombre }}</td>
                <td>{{ $docente->apellido }}</td>
                <td>{{ $docente->email }}</td>
                <td>{{ $docente->dni }}</td>
                <td>{{ $docente->legajo }}</td>
                <td style="width: 23%">
                    <a href="{{ route('docentes.edit',$docente->id) }}"><button class="btn btn-warning btn-sm" >Editar</button></a>
                    <button class="btn btn-danger btn-sm" href="#">Desactivar</button>
                    <button class="btn btn-success btn-sm" href="#">Activar</button>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center">No se encontraron resultados</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="row justify-content-center">
        {{ $docentes->links() }}
    </div>





@endsection






