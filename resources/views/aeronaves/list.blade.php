@extends('layouts.app')

@section('title', 'Aeronaves')

@section('content')
<div class="container">
    @can('create', App\Aeronave::class)
    <div>
        <a class="btn btn-primary" href="{{route('aeronaves.create')}}">Adicionar</a>
    </div>
    @endcan
    @if(count($aeronaves) > 0)
    <table class="table table-striped">
        <thead>
            <tr>
                <td>Matricula</td>
                <td>Marca</td>
                <td>Modelo</td>
                <td>Numero de Lugares</td>
                <td>Total Horas</td>
                <td>Preço Hora</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($aeronaves as $aeronave)
            @if($aeronave->deleted_at != NULL)
                @continue
            @endif
            <tr>
                <td>{{ $aeronave->matricula }}</td>
                <td>{{ $aeronave->marca }}</td>
                <td>{{ $aeronave->modelo }}</td>
                <td>{{ $aeronave->num_lugares }}</td>
                <td>{{ $aeronave->conta_horas }}</td>
                <td>{{ $aeronave->preco_hora }}</td>
                <td> <!-- IMPLEMENTAR VALIDAÇÃO PARA SO OS SOCIOS da direção -->
                    <a class="btn btn-xs btn-primary" href="{{route('aeronaves.pilotosIndex', $aeronave) }}">Mostrar pilotos</a>
                    @can('update', $aeronave)
                    <a class="btn btn-xs btn-primary" href="{{route('aeronaves.edit', $aeronave)}}">Editar</a>
                    @endcan
                    @can('delete', $aeronave)
                    <form action="{{route('aeronaves.destroy', $aeronave)}}" method="POST" role="form" class="inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-xs btn-danger">Apagar</button>
                    </form>
                    @endcan
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $aeronaves->links() }}

    @else
        <h2>Nenhuma aeronave encontrada</h2>
    @endif

</div>
@endsection

