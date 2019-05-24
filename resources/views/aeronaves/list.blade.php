@extends('layouts.app')

@section('title', 'Aeronaves')

@section('content')


<div class="container">
    @if(count($aeronaves) > 0)
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Matrícula</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Número de Lugares</th>
                <th>Total Horas</th>
                <th>Preço Hora</th>
                <th>Pilotos</th>
                <th></th>
                <th></th>
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
                <td> {{ floor($aeronave->conta_horas / 10) }}h {{ $aeronave->roundContaHoras($aeronave->conta_horas- floor($aeronave->conta_horas / 10) * 10) }}m </td>
                <td>{{ $aeronave->preco_hora }} / 
                    @can('view', $aeronave)
                    <a class="link" href="{{route('aeronaves.precos_temposIndex', $aeronave) }}">Mais preços</a>
                    @endcan
                </td>
                <td>
                    @can('authorize', $aeronave)
                    <a class="link" href="{{route('aeronaves.pilotosIndex', $aeronave) }}">Pilotos Autorizados</a>
                    ({{ $aeronave->pilotos()->count() }})
                    @endcan
                </td>
                <td>
                    @can('update', $aeronave)
                    <a class="btn  btn-primary" href="{{route('aeronaves.edit', $aeronave)}}">Editar</a>
                    @endcan
                </td>
                <td>
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
    
    @can('create', App\Aeronave::class)
    <div>
        <a class="btn btn-primary" href="{{route('aeronaves.create')}}">Adicionar</a>
    </div>
    @endcan

</div>
@endsection

