@extends('layouts.app')

@section('title', 'Editar Aeronave')

@section('content')

<nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('user.home') }}">Flight-Club</a></li>
            <li class="breadcrumb-item"><a href="{{ route('aeronaves.index') }}">Aeronaves</a></li>
            <li class="breadcrumb-item active">{{ $aeronave->matricula }} </li>
            <li class="breadcrumb-item active">Editar</li>
        </ol>
</nav>

<form action="{{route('aeronaves.update', $aeronave)}}" method="post" class="form-group">
    {{method_field('PUT')}}



    @include('aeronaves.partials.add-edit')
    <br>
    <h3> Tabela de Preços</h3>
    <div class="form-group table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Unidade Conta-Horas</th>
                    <th>Minutos</th>
                    <th>Preço</th>
                </tr>
            </thead>
            <tbody>
            @php 
                $i=0;
            @endphp

                @foreach($precos_tempos as $preco_tempo)
                    <tr>
                        <td>{{ $preco_tempo->unidade_conta_horas }}</td>
                        <!--td>{{ $preco_tempo->minutos }}</td-->
                        <td><input type="number" min="0" class="form-control" name="minutos[]" id="inputMinutos{{$i}}" value="{{old('minutos.$i', $preco_tempo->minutos )}}"/></td>

                        @if($i < 9)
                            <td><input type="number" min="0" class="form-control" name="precos[]" id="inputPreco{{$i}}" value="{{old('precos.$i', $preco_tempo->preco )}}"/></td>
                        @else
                            <td><input type="number" min="0" class="form-control" name="precos[]" id="inputPreco9" onchange="setPrecoHora()" value="{{old('precos.9', $preco_tempo->preco )}}"/></td>                    
                        @endif
                    </tr>
                    @php 
                        $i++;
                    @endphp
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


<!-- SCRIPT PARA ALTERAR OS VALORES DAS UNIDADES DE TEMPO AUTOMATICAMENTE. SE O UTILIZADOR DER OVERRIDE ESSES PREVALECEM -->
<script type="text/javascript">

    function calcularPrecosUnidades(){

        var precoHora = document.getElementById('inputPrecoHora').value;
       
        var inputPrecos = [
            document.getElementById('inputPreco0'),
            document.getElementById('inputPreco1'),
            document.getElementById('inputPreco2'),
            document.getElementById('inputPreco3'),
            document.getElementById('inputPreco4'),
            document.getElementById('inputPreco5'),
            document.getElementById('inputPreco6'),
            document.getElementById('inputPreco7'),
            document.getElementById('inputPreco8'),
            document.getElementById('inputPreco9'),
        ];

        for (let i = 0; i < inputPrecos.length; i++) {
            inputPrecos[i].value = calculaPrecosUnidade(i+1, precoHora);
        }
    }

    function calculaPrecosUnidade(unidadeTempo, precoHora) {
        return Math.ceil(precoHora * unidadeTempo / 10);
    }

    function setPrecoHora() {
        var inputPrecoHora = document.getElementById('inputPrecoHora');
        var inputPrecoUnidade10 = document.getElementById('inputPreco9');

        if (inputPrecoHora.value != inputPrecoUnidade10.value) {
            inputPrecoHora.value = inputPrecoUnidade10.value;
            calcularPrecosUnidades();
        }
    }

</script>

