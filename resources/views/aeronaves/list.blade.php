@extends('layouts.app')


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
        </tr>
    @endforeach
    </table>

    {{ $aeronaves->links() }}

</div>
@endsection

