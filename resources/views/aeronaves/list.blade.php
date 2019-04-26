@extends('layouts.app')


@section('content')
<div class="container">
    <table>
        <tr><td>Matricula</td>
            <td>Marca</td>
            <td>Modelo</td>
            <td>Numero de Lugares</td></tr>
    @foreach ($aeronaves as $aeronave)
        <tr>
            <td>{{ $aeronave->matricula }}</td>
            <td>{{ $aeronave->marca }}</td>
            <td>{{ $aeronave->modelo }}</td>
            <td>{{ $aeronave->num_lugares }}</td>
        </tr>
    @endforeach
    </table>

    {{ $aeronaves->links() }}

</div>
@endsection

