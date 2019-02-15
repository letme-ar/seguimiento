@extends('layouts.app')

@section('scripts')

<style>

    .defused{
        background-color: red;
        color: white;
    }

    .no-gutter {
        padding:0;
    }

    .inline-block {
        display: inline-block;
    }

</style>
<script>
    // $(document).ready(function(){
    //     $('[data-toggle="tooltip"]').tooltip()
    // });

</script>


@endsection
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
            @if($docente->user->status)
            <tr >
            @else
            <tr class="defused">
            @endif
                <td>{{ $docente->nombre }}</td>
                <td>{{ $docente->apellido }}</td>
                <td>{{ $docente->email }}</td>
                <td>{{ $docente->dni }}</td>
                <td>{{ $docente->legajo }}</td>
                <td>
                    <a href="{{ 'docentes/edit/'.$docente->id."-".$docente->url }}"><span class="oi oi-pencil" title="Editar" data-toggle="tooltip" data-placement="top"></span></a>
                    @if($docente->user->status)
                        <form action="{{ route('users.defuse', $docente->user->id) }}" method="POST" class="inline-block">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-link no-gutter"><span class="oi oi-trash"></span></button>
                        </form>
{{--                        <a href="{{ route('docentes.defuse',$docente->id) }}"><span class="oi oi-circle-x" title="Deshabilitar"></span></a>--}}
                    @else
                        <form action="{{ route('users.activate', $docente->user->id) }}" method="POST" class="inline-block">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-link no-gutter"><span class="oi oi-circle-check"></span></button>
                        </form>
                    @endif
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






