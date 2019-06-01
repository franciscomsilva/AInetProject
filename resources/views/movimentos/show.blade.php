@extends('layouts.app')

@section('title','Detalhes Movimento')

@section('content')

    <!-- Secção das breadcrumbs -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('user.home') }}">Flight-Club</a></li>
            <li class="breadcrumb-item"><a href="{{ route('movimentos.index') }}">Movimentos</a></li>
            <li class="breadcrumb-item active">{{ $movimento->id }}</li>
        </ol>
    </nav>




        <div class="card" style="margin-bottom: 50px;">
            <div class="card-header">
                <h3 class="card-title">Movimento</h3>
            </div>
            <div class="card-body">
                <div class="row" style="padding-bottom: 10px">
                    <div class="col">
                        <h5>ID: </h5>
                        <span>{{$movimento->id}}</span>
                    </div>
                    <div class="col">
                        <h5>Data: </h5>
                        <span>{{$movimento->data}}</span>
                    </div>
                    <div class="col">
                        <h5>Hora Aterragem: </h5>
                        <span>{{date('H:i', strtotime($movimento->hora_aterragem))}}</span>
                    </div>
                </div>
                <div class="row" style="padding-bottom: 10px">
                    <div class="col">
                        <h5>Hora Descolagem: </h5>
                        <span>{{date('H:i', strtotime($movimento->hora_descolagem))}}</span>
                    </div>
                    <div class="col">
                        <h5>Aeronave: </h5>
                        <span>{{$movimento->aeronave}}</span>
                    </div>
                    <div class="col">
                        <h5>Número Diário: </h5>
                        <span>{{$movimento->num_diario}}</span>
                    </div>
                </div>
                <div class="row" style="padding-bottom: 10px">
                    <div class="col">
                        <h5>Número Serviço: </h5>
                        <span>{{$movimento->num_servico}}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card" style="margin-bottom: 50px;">
            <div class="card-header">
                <h3 class="card-title">Piloto</h3>
            </div>
            <div class="card-body">
                <div class="row" style="padding-bottom: 10px">
                    <div class="col">
                        <h5>Nome: </h5>
                        <span>{{$movimento->piloto_id}}</span>
                    </div>
                    <div class="col">
                        <h5>Licença Piloto: </h5>
                        <span>{{$movimento->num_licenca_piloto}}</span>
                    </div>

                    <div class="col">
                        <h5>Validade Licença: </h5>
                        <span>{{$movimento->validade_licenca_piloto}}</span>
                    </div>
                </div>
                <div class="row" style="padding-bottom: 10px">
                    <div class="col">
                        <h5>Tipo Licença: </h5>
                        <span>{{$movimento->tipo_licenca_piloto}}</span>
                    </div>
                    <div class="col">
                        <h5>Número Certificado: </h5>
                        <span>{{$movimento->num_certificado_piloto}}</span>
                    </div>
                    <div class="col">
                        <h5>Validade Certificado: </h5>
                        <span>{{$movimento->validade_certificado_piloto}}</span>
                    </div>
                </div>
                <div class="row" style="padding-bottom: 10px">
                    <div class="col">
                        <h5>Classe Certificado: </h5>
                        <span>{{$movimento->classe_certificado_piloto}}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card" style="margin-bottom: 50px;">
            <div class="card-header">
                <h3 class="card-title">Voo</h3>
            </div>
            <div class="card-body">
                <div class="row" style="padding-bottom: 10px">
                    <div class="col">
                        <h5>Natureza: </h5>
                        <span>{{$movimento->naturezaMovimentoToString()}}</span>
                    </div>
                    <div class="col">
                        <h5>Aerodromo de Partida: </h5>
                        <span>{{$movimento->aerodromo_partida}}</span>
                    </div>
                    <div class="col">
                        <h5>Aerodromo de Chegada: </h5>
                        <span>{{$movimento->aerodromo_chegada}}</span>
                    </div>
                </div>
                <div class="row" style="padding-bottom: 10px">
                    <div class="col">
                        <h5>Número de Aterragens: </h5>
                        <span>{{$movimento->num_aterragens}}</span>
                    </div>
                    <div class="col">
                        <h5>Número de Deslocagens: </h5>
                        <span>{{$movimento->num_deslocagens}}</span>
                    </div>
                    <div class="col">
                        <h5>Número de Pessoas: </h5>
                        <span>{{$movimento->num_pessoas}}</span>
                    </div>
                </div>
                <div class="row" style="padding-bottom: 10px">
                    <div class="col">
                        <h5>Conta-Horas Inicio: </h5>
                        <span>{{$movimento->conta_horas_inicio}}</span>
                    </div>
                    <div class="col">
                        <h5>Conta-Horas Fim: </h5>
                        <span>{{$movimento->conta_horas_fim}}</span>
                    </div>
                    <div class="col">
                        <h5>Tempo Voo: </h5>
                        <span>{{$movimento->tempo_voo}}</span>
                    </div>
                </div>
                <div class="row" style="padding-bottom: 10px">
                    <div class="col">
                        <h5>Preço Voo: </h5>
                        <span>{{$movimento->preco_voo}}</span>
                    </div>
                    <div class="col">
                        <h5>Modo Pagamento: </h5>
                        <span>{{$movimento->modoPagamentoToString()}}</span>
                    </div>
                    <div class="col">
                        <h5>Número Recibo: </h5>
                        <span>{{$movimento->num_recibo}}</span>
                    </div>
                </div>
                <div class="row" style="padding-bottom: 10px">
                    <div class="col">
                        <h5>Observações: </h5>
                        <span>{{$movimento->observacoes}}</span>
                    </div>
                    <div class="col">
                        <h5>Confirmado: </h5>
                        <span>{{$movimento->confirmadoToString()}}</span>
                    </div>
                    <div class="col">
                        <h5>Tipo Instrução: </h5>
                        <span>{{$movimento->tipoInstrucaoToString()}}</span>
                    </div>
                </div>
            </div>
        </div>
        @if(($movimento->natureza)=='I' )
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Instrutor</h3>
        </div>
        <div class="card-body">
            <div class="row" style="padding-bottom: 10px">
                <div class="col">
                    <h5>Nome: </h5>
                    <span>{{$movimento->instrutor_id}}</span>
                </div>
                <div class="col">
                    <h5>Licença: </h5>
                    <span>{{$movimento->num_licenca_instrutor}}</span>
                </div>
                <div class="col">
                    <h5>Validade Licença: </h5>
                    <span>{{$movimento->validade_licenca_instrutor}}</span>
                </div>
            </div>
            <div class="row" style="padding-bottom: 10px">
                <div class="col">
                    <h5>Tipo Licença: </h5>
                    <span>{{$movimento->tipo_licenca_instrutor}}</span>
                </div>
                <div class="col">
                    <h5>Número Certificado: </h5>
                    <span>{{$movimento->num_certificado_instrutor}}</span>
                </div>
                <div class="col">
                    <h5>Validade Certificado: </h5>
                    <span>{{$movimento->validade_certificado_instrutor}}</span>
                </div>
            </div>
            <div class="row" style="padding-bottom: 10px">
                <div class="col">
                    <h5>Classe Certificado: </h5>
                    <span>{{$movimento->classe_certificado_instrutor}}</span>
                </div>
            </div>
        </div>
    </div>
            @endif
            @can('update', $movimento)
                <a class="btn btn-xs btn-primary" href="{{route('movimentos.edit', $movimento)}}">Editar</a>
            @endcan

@endsection
