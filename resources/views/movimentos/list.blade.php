{{csrf_field()}}
@extends('layouts.app')

@section('title','Movimentos')

@section('content')
    <form action="{{URL::Current()}}">
        <div class="row">
            <div class="col">
                <label for="id">ID:</label>
                <input type="number" name="id" class="form-control"/>
            </div>
            <div class="col">
                <label for="aeronave">Matricula</label>
                <select name="aeronave" class="form-control">
                    <option value=""></option>
                    @foreach($aeronaves as $aeronave)
                        <option value="{{$aeronave->matricula}}">{{$aeronave->matricula}}</option>
                    @endforeach
                </select>
            </div></div>
        <div class="row"><div class="col">
                <label for="data_inf">Data Inferior</label>
                <input
                        type="date" name="data_inf" class="form-control"
                        placeholder="Data Inferior" {{old('dataInfPesquisa')}}/>
            </div><div class="col">
                <label for="data_sup">Data Superior</label>
                <input
                        type="date" name="data_sup" class="form-control"
                        placeholder="Data Superior" {{old('dataSupPesquisa')}}>
            </div></div>
        <div class="row"><div class="col">
                <label for="natureza">Natureza</label>
                <select name="natureza" class="form-control">
                    <option disabled selected> -- Natureza -- </option>
                    <option value="T">Treino</option>
                    <option value="I">Instrução</option>
                    <option value="E">Especial</option>
                </select>
            </div><div class="col">
                <label for="confirmado">Confirmado</label>
                <select name="confirmado" class="form-control">
                    <option disabled selected value></option>
                    <option  value="1">Sim</option>
                    <option  value="0">Não</option>
                </select>
            </div></div>
        <div class="row"><div class="col">
                <label for="piloto">Piloto</label>
                <input type="text" name="piloto" placeholder="Nome Piloto" class="form-control">
            </div><div class="col">
                <label for="instrutor">Instrutor</label>
                <input type="text" name="instrutor" placeholder="Nome Instrutor" class="form-control">
            </div>
            @if(Auth::user()->tipo_socio=='P')
            <div class="col">
                <label></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <input type="checkbox" name="meusMovimentosPesquisa" {{old('meusMovimentosPesquisa')}}>
                        </div>
                    </div>
                    <label type="text" class="form-control"> Meus Movimentos
                    </label></div></div>
            @endif
            <div class="col">
                <label></label>
                <button type="submit" class="btn btn-success form-control" name="search">Pesquisar</button>
            </div></div>
    </form>
    <br>
    <div class="container">
        @if (count($errors) > 0)
            @include('shared.errors')
        @endif

        <div>@can('create', App\Movimento::class)
            <a class="btn btn-primary" href="{{route('movimentos.create')}}">Adicionar</a>
            @endcan
            @if(Auth::user()->direcao)
                <a class="btn btn-xs btn-info" href="{{route('movimentos.confirmados')}}">Confirmar</a>
            @endif
        </div>

        @if (count($movimentos))
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Aeronave</th>
                    <th>Data</th>
                    <th>Hora Aterragem</th>
                    <th>Hora Descolagem</th>
                    <th>Tempo</th>
                    <th>Natureza</th>
                    <th>Piloto Nome</th>
                    <th>Aeródromo Partida</th>
                    <th>Aeródromo Chegada</th>
                    <th>Nº Aterragens</th>
                    <th>Nº Descolagens</th>
                    <th>Nº Diário</th>
                    <th>Nº Serviço</th>
                    <th>Conta-Horas Inicial</th>
                    <th>Conta-Horas Final</th>
                    <th>Nº Pessoas</th>
                    <th>Tipo Instrução</th>
                    <th>Instrutor</th>
                    <th>Confirmado</th>
                    <th> </th>
                </tr>
                </thead>
                <tbody>
                @foreach($movimentos as $movimento)
                    <tr>
                        <td>{{$movimento->id}}</td>
                        <td>{{$movimento->aeronave}}</td>
                        <td>{{date('d/m/Y', strtotime($movimento->hora_aterragem))}}</td>
                        <td>{{date('H:i', strtotime($movimento->hora_aterragem))}}</td>
                        <td>{{date('H:i', strtotime($movimento->hora_descolagem))}}</td>
                        <td>{{$movimento->tempo_voo}} min</td>
                        <td>{{$movimento->naturezaMovimentoToString()}}</td>
                        <td>{{$movimento->piloto->nome_informal}}</td>
                        <td>{{$movimento->aerodromo_partida}}</td>
                        <td>{{$movimento->aerodromo_chegada}}</td>
                        <td>{{$movimento->num_aterragens}}</td>
                        <td>{{$movimento->num_descolagens}}</td>
                        <td>{{$movimento->num_diario}}</td>
                        <td>{{$movimento->num_servico}}</td>
                        <td>{{$movimento->conta_horas_inicio}}</td>
                        <td>{{$movimento->conta_horas_fim}}</td>
                        <td>{{$movimento->num_pessoas}}</td>
                        <td>{{$movimento->tipoInstrucaoToString()}}</td>
                        <td>{{$movimento->instrutor==null ? '' : $movimento->nome_informal}}</td>
                        <td>
                            <div class="input-group mb-3">
                                <div class="input-group">
                                    <input type="checkbox" name={{"confirmado".$movimento->id}} {{$movimento->confirmado==1 ? ' disabled checked' : ''}}>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a class="btn btn-xs btn-primary" href="{{route('movimentos.show', $movimento)}}"><img src="/imagens/eye.png" class="" alt="mostrar"></a>
                            @can('update', $movimento)
                                <a class="btn btn-xs btn-primary" href="{{route('movimentos.edit', $movimento)}}"><img src="/imagens/pencil.png" class="" alt="editar"></a>
                            @endcan
                            @can('delete', $movimento)
                                <form action="{{route('movimentos.destroy', $movimento)}}" method="POST" role="form" class="inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-xs btn-danger"><img src="/imagens/delete.png" class="" alt="apagar"></button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </table>
                {{$movimentos->links()}}


        @else

            <h2>Não existem registos!</h2>

        @endif
    </div>
@endsection

