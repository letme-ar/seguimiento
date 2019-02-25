@extends('layouts.app')


@section('content')

    <h1>Listado de cursos</h1>

    <a href="{{ route('cursos.create') }}" class="btn btn-primary">Cargar nuevo curso</a>

    <table class="table table-hover table-sm" style="margin-top: 10px">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Carrera</th>
            <th scope="col">Materia</th>
            <th scope="col">Año</th>
            <th scope="col">Horario</th>
            <th scope="col">Ayudante</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @forelse($cursos as $curso)
            <tr>
                <td>{{ $curso->materia->carrera->descripcion }}</td>
                <td>{{ $curso->materia->descripcion }}</td>
                <td>{{ $curso->anio }}</td>
                <td>{{ $curso->horario->descripcion }}</td>
                <td>{{ $curso->ayudante->full_name ?? ''}}</td>
                <td>
                    <a href="{{ 'cursos/edit/'.$curso->id."-".$curso->slug }}"><span class="oi oi-pencil" title="Editar" data-toggle="tooltip" data-placement="top"></span></a>

                    {{--@if($docente->user->status)--}}
                        {{--<form action="{{ route('users.defuse', $docente->user->id) }}" method="POST" class="inline-block">--}}
                            {{--{{ csrf_field() }}--}}
                            {{--{{ method_field('DELETE') }}--}}
                            {{--<button type="submit" class="btn btn-link no-gutter" id="{{$docente->user->id}}-trash" title="Desactivar"><span class="oi oi-trash"></span></button>--}}
                        {{--</form>--}}
                    {{--@else--}}
                        {{--<form action="{{ route('users.activate', $docente->user->id) }}" method="POST" class="inline-block">--}}
                            {{--{{ csrf_field() }}--}}
                            {{--<button type="submit" class="btn btn-link no-gutter" id="{{$docente->user->id}}-check" title="Activar"><span class="oi oi-circle-check"></span></button>--}}
                        {{--</form>--}}
                    {{--@endif--}}
                    {{--<form action="{{ route('users.restartPassword', $docente->user->id) }}" method="POST" class="inline-block">--}}
                        {{--{{ csrf_field() }}--}}
                        {{--<button type="submit" class="btn btn-link no-gutter" id="{{$docente->user->id}}-check" title="Reinciar contraseña"><span class="oi oi-reload"></span></button>--}}
                    {{--</form>--}}
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
        {{ $cursos->links() }}
    </div>



@endsection
