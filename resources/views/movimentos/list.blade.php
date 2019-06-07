{{csrf_field()}}
@extends('layouts.app')

@section('title','Movimentos')

@section('content')

<!-- Secção das breadcrumbs -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('user.home') }}">Flight-Club</a></li>
        <li class="breadcrumb-item active">Movimentos</li>
    </ol>
</nav>

<!-- Secção dos filtros -->
<div class="row">
    <div class="col-md-9">
        <div class="card" style="margin-bottom: 50px;">
            <div class="form-group">
                <div class="card-header">
                    <h3 class="card-title">Filtrar</h3>
                </div>
                <div class="card-body">
                    <form action="{{URL::Current()}}">
                        <div class="row">
                            <div class="col">
                                <label for="id">ID Movimento:</label>
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
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <label for="data_inf">Data Inferior (Até á Data)</label>
                                <input type="date" name="data_inf" class="form-control" placeholder="Data Inferior" value="{{old('dataInfPesquisa')}}"/>
                            </div>
                            <div class="col">
                                <label for="data_sup">Data Superior (Depois da Data)</label>
                                <input
                                        type="date" name="data_sup" class="form-control"
                                        placeholder="Data Superior" value="{{old('dataSupPesquisa' )}}"> 
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <label for="natureza">Natureza</label>
                                <select name="natureza" class="form-control">
                                    <option disabled selected> -- Natureza -- </option>
                                    <option value="T">Treino</option>
                                    <option value="I">Instrução</option>
                                    <option value="E">Especial</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="confirmado">Confirmado</label>
                                <select name="confirmado" class="form-control">
                                    <option disabled selected value></option>
                                    <option  value="1">Sim</option>
                                    <option  value="0">Não</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="nrAterragens">Nº Aterragens</label>
                                <input type="number" name="nrAterragens" class="form-control"/>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <label for="piloto">Piloto</label>
                                <input type="text" name="piloto" placeholder="Nome Piloto" class="form-control">
                            </div>
                            <div class="col">
                                <label for="instrutor">Instrutor</label>
                                <input type="text" name="instrutor" placeholder="Nome Instrutor" class="form-control">
                            </div>
                            @if(Auth::user()->tipo_socio=='P')
                                <div class="col">
                                    <br>
                                    <label></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="checkbox" name="meusMovimentos">
                                            </div>
                                        </div>
                                        <label type="text" class="form-control">Meus Movimentos</label>
                                    </div>
                                </div>
                            @endif
                            <div class="col">
                                <br>
                                <label></label>
                                <button type="submit" class="btn btn-success form-control">Pesquisar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Ações</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    @can('create', App\Movimento::class)
                        <div class="row">
                            <div class="col">
                                <a class="btn btn-primary" style="width: 100%" href="{{route('movimentos.create')}}">Adicionar</a>
                            </div>
                        </div>
                    @endcan
                    <br>
                    @if(Auth::user()->direcao)                        
                        <div class="row">
                            <div class="col">
                                <a class="btn btn-info" style="width: 100%" href="{{route('movimentos.confirmado')}}">Confirmar</a>
                            </div>
                        </div>
                    @endif
                    
                    <br> <!-- Movimentos pendentess -->
                
                    <div class="row">
                        <div class="col">
                            <a class="btn btn-info" style="width: 100%" href="{{route('movimentos.estatisticas')}}">Estatísticas</a>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>

</div> <!-- end div 'container' -->
<div>
    @if (count($movimentos))
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Aeronave</th>
                <th>Data</th>
                <th>Hora Descolagem / Aterragem</th> 

                <th>Tempo</th>
                <th>Natureza</th>
                <th>Piloto <!--Nome--></th>
                
                <th>Aeródromo Partida / Chegada</th>
                
                <th>Nº Descolagens / Aterragens</th>

                <th>Nº Diário</th>
                <th>Nº Serviço</th>
                <th>Conta-Horas Inicial / Final</th>

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
                    <td>{{date('H:i', strtotime($movimento->hora_descolagem))}} / {{date('H:i', strtotime($movimento->hora_aterragem))}}</td>
                    <td>{{$movimento->tempo_voo}} min</td>
                    <td>{{$movimento->naturezaMovimentoToString()}}</td>
                    <td>{{$movimento->piloto->nome_informal}}</td>
                    <td>{{$movimento->aerodromo_partida}} / {{$movimento->aerodromo_chegada}}</td>
                    <td>{{$movimento->num_descolagens}} / {{$movimento->num_aterragens}}</td>
                    <td>{{$movimento->num_diario}}</td>
                    <td>{{$movimento->num_servico}}</td>
                    <td>{{$movimento->conta_horas_inicio}} / {{$movimento->conta_horas_fim}}</td>
                    <td>{{$movimento->num_pessoas}}</td>
                    <td>{{$movimento->tipoInstrucaoToString()}}</td>
                    <td>{{$movimento->instrutor==null ? '' : $movimento->instrutor->nome_informal}}</td>
                    <td>
                        <div class="input-group mb-3">
                            <div class="input-group">
                                <input type="checkbox" name="confirmado" value="{{$movimento->confirmado}}" {{$movimento->confirmado==1 ? ' disabled checked' : ''}}>
                            </div>
                        </div>
                    </td>
                    <td>
                    <div class="dropdown-lg">
                        <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Opções
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            
                            
                            <a class="dropdown-item" href="{{route('movimentos.show', $movimento)}}">Ver</a>
                            
                            @can('update', $movimento)
                                <a class="dropdown-item" href="{{route('movimentos.edit', $movimento)}}">Editar</a>
                            @endcan
                            
                            @can('delete', $movimento)
                                <form action="{{route('movimentos.destroy', $movimento)}}" method="POST" role="form" class="inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="dropdown-item">Apagar </button>
                                </form>
                            @endcan
                            
                        </div>

                    </div>
                    </td>
                </tr>
            @endforeach
        </table>
            {{$movimentos->appends(Request()->input())->links()}}


    @else

        <h2>Não existem registos!</h2>

    @endif

@endsection

