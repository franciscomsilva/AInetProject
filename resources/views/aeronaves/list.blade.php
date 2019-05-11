@extends('layouts.app')

@section('title', 'Aeronaves')

@section('content')
<div class="container">
    <div>
        <a class="btn btn-primary" href="{{route('aeronaves.create')}}">Adicionar</a>
    </div>
    <table>
        <tr>
            <td>Matricula</td>
            <td>Marca</td>
            <td>Modelo</td>
            <td>Numero de Lugares</td>
            <td>Total Horas</td>
            <td>Preço Hora</td>
        </tr>
    @foreach ($aeronaves as $aeronave)
        <tr>
            <td>{{ $aeronave->matricula }}</td>
            <td>{{ $aeronave->marca }}</td>
            <td>{{ $aeronave->modelo }}</td>
            <td>{{ $aeronave->num_lugares }}</td>
            <td>{{ $aeronave->conta_horas }}</td>
            <td>{{ $aeronave->preco_hora }}</td>
            <td> <!-- IMPLEMENTAR VALIDAÇÃO PARA SO OS SOCIOS da direção -->
                <a class="btn btn-xs btn-primary" href="{{route('aeronaves.edit', $aeronave)}}">Editar</a>
                <form action="{{route('aeronaves.destroy', $aeronave)}}" method="POST" role="form" class="inline">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-xs btn-danger">Apagar</button>
                </form>
            </td>
        </tr>
    @endforeach
    </table>

    {{ $aeronaves->links() }}

</div>
@endsection

