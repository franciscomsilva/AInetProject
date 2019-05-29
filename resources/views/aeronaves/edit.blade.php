@extends('layouts.app')

@section('title', 'Editar Aeronave')

@section('content')


<form action="{{route('aeronaves.update', $aeronave)}}" method="post" class="form-group">
    {{method_field('PUT')}}



    @include('aeronaves.partials.add-edit')
    <br>
    <h3> Tabela de Preços</h3>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Unidade Conta-Horas</th>
                    <th>Minutos</th>
                    <th>Preço</th>
                </tr>
            </thead>
            <tbody>
                    @php ($i = 0)
                @foreach($precos_tempos as $preco_tempo)
                    <tr>
                        <td>{!! $preco_tempo->unidade_conta_horas !!}</td>
                        <td>{!! $preco_tempo->minutos !!}</td>
                        <td><input type="number" min="1" class="form-control" name="preco{{$i}}" id="inputPreco{{$i}}" value="{{old('preco_hora', $preco_tempo->preco )}}"/></td>
                    </tr>
                    @php ($i++)
                @endforeach
            </tbody>
        </table>
    </div>


    <div class="form-group">
        <button type="submit" class="btn btn-success" name="ok">Guardar</button>
        <a type="submit" class="btn btn-default" name="cancel" href="{{route('aeronaves.index')}}">Cancelar</a>
    </div>
</form>
@endsection
