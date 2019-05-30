@extends('layouts.app')

@section('title', 'Aeronaves')

@section('content')


<div class="container">

    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('user.home') }}">Flight-Club</a></li>
        <li class="breadcrumb-item active">Aeronaves</li>
    </ol>
    </nav>

    @if(count($aeronaves) > 0)
    <table class="table table-striped" style="text-alighn: center;">
        <thead>
            <tr>
                <th>Matrícula</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Nº de Lugares</th>
                <th>Horas e Minutos</th>
                <th>Preço Hora</th>
                
                @can('authorize', App\Aeronave::class)
                <th>Pilotos</th>
                @endcan
                <th></th>
                <th>
                    @can('create', App\Aeronave::class)
                        <div>
                            <a class="btn btn-primary" href="{{route('aeronaves.create')}}">Adicionar</a>
                        </div>
                    @endcan
                </th>
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
                <td> 
                    @if( $aeronave->conta_horas > 0)
                        {{ floor($aeronave->conta_horas / 10) }}h 
                        @if( ($minutos = $aeronave->roundContaHoras($aeronave->conta_horas- floor($aeronave->conta_horas / 10) * 10)) > 0 )
                            {{ $minutos }}m 
                        @endif
                    @else
                        0h
                    @endif
                </td>
                <td>{{ $aeronave->preco_hora }}
                    @can('view', $aeronave)
                    / 
                    <a class="link" href="{{route('aeronaves.precos_temposIndex', $aeronave) }}">Mais preços</a>
                    @endcan
                </td>
                <td>
                    @can('authorize', $aeronave)
                        @if($aeronave->pilotos()->count() > 0)
                            <a class="link" href="{{route('aeronaves.pilotosIndex', $aeronave) }}">Pilotos Autorizados</a>
                            ({{ $aeronave->pilotos()->count() }})
                        @else
                            <a class="link" href="{{route('aeronaves.pilotosNaoAutorizadosIndex', $aeronave) }}">Autorizar Pilotos</a>
                        @endif
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
        @can('create', App\Aeronave::class)
            <div>
                <a class="btn btn-primary" href="{{route('aeronaves.create')}}">Adicionar</a>
            </div>
            <br>
        @endcan

        <h2>Nenhuma aeronave encontrada</h2>
    @endif


</div>
@endsection

