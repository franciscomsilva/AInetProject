{{csrf_field()}}

<!--Data-->
<div class="form-group">
    <label for="inputData">Data</label>
    <input type="date" id="inputData" name="data" value="{{old('data', $movimento->data)}}" class="form-control">
</div>
<!--Hora Deslocagem-->
<div class="form-group">
    <label for="inputHoraDescolagem">Hora Descolagem</label>
    <input type="time" id="inputHoraDescolagem" name="horaDescolagem" value="{{old('horaDescolagem', date('H:i', strtotime($movimento->hora_descolagem)))}}" class="form-control">
</div>
<!--Hora Aterragem-->
<div class="form-group">
    <label for="inputHoraAterragem">Hora Aterragem</label>
    <input type="time" id="inputHoraAterragem" name="horaAterragem" value="{{old('horaAterragem', date('H:i', strtotime($movimento->hora_aterragem)))}}" class="form-control">
</div>
<!--Aeronave-->
<div class="form-group">
    <label for="inputAeronave">Aeronave</label>
    <select name="aeronaves" id="inputAeronaves" class="form-control">
        @foreach($aeronaves as $aeronave)
            <option value="{{$aeronave->matricula}}" {{old('aeronaves', $movimento->aeronave)==$aeronave->matricula? 'selected' : ''}}>{{$aeronave->matricula}}</option>
            @endforeach
        </select>
    </div>
<!--Numero Diario-->
<div class="form-group">
    <label for="inputNumDiario">Número Diário</label>
    <input type="number" id="inputNumDiario" name="numDiario" value="{{old('numDiario', $movimento->num_diario)}}" class="form-control">
</div>
<!--Numero de Servico-->
<div class="form-group">
    <label for="inputNumServico">Número Serviço</label>
    <input type="number" id="inputNumServico" name="numServico" value="{{old('numServico', $movimento->num_servico)}}" class="form-control">
</div>
<!--Piloto-->
<div class="form-group">
    <label for="inputPiloto">Piloto</label>
    <select name="pilotos" id="inputPilotos" class="form-control">
        @foreach($pilotos as $piloto)
            <option value="{{$piloto->id}}" {{ $piloto->name == Auth::user()->name ? 'selected' : ''}}>{{$piloto->name}}</option>
        @endforeach
    </select>
</div>
<!--Num Licença-->
<div class="form-group">
    <label for="inputNumLincenca">Número Licença</label>
    <input type="number" class="form-control" id="inputNumLincenca" name="inputNumLincenca" value="{{old('inputNumLincenca', $movimento->num_licenca_piloto)}}"/>
</div>
<!--Validade Licença-->
<div class="form-group">
    <label for="inputValidadeLincenca">Validade Licença</label>
    <input type="date" class="form-control" id="inputValidadeLincenca" name="inputValidadeLincenca" value="{{old('inputValidadeLincenca', $movimento->validade_licenca_piloto)}}"/>
</div>
<!--Tipo Licença-->
<div class="form-group">
    <label for="inputTipoLicenca">Tipo Licença</label>
    <select name="tipoLicenca" id="inputTipoLicenca" class="form-control">
        @foreach($tipoLicencas as $tipoLicenca)
            <option value="{{$tipoLicenca->code}}" {{ old('inputTipoLicenca', $movimento->tipo_licenca_piloto) ? 'selected' : ''}}>{{$tipoLicenca->nome}}</option>
        @endforeach
    </select>
</div>
<!--Num Certificado-->
<div class="form-group">
    <label for="inputNumCertificado">Número Certificado</label>
    <input type="number" class="form-control" id="inputNumCertificado" name="inputNumCertificado" value="{{old('inputNumCertificado', $movimento->num_Certificado_piloto)}}"/>
</div>
<!--Validade Certificado-->
<div class="form-group">
    <label for="inputValidadeCertificado">Validade Certificado</label>
    <input type="date" class="form-control" id="inputValidadeCertificado" name="inputValidadeCertificado" value="{{old('inputValidadeCertificado', $movimento->validade_Certificado_piloto)}}"/>
</div>
<!--Natureza-->
<div class="form-group">
    <label for="inputNatureza">Natureza</label>
    <select name="natureza" id="inputNatureza" class="form-control">
        <option disabled> -- Selecione uma opção -- </option>
        <option value="T" {{ old('natureza',$movimento->natureza)=='T' ? 'selected' : '' }}>Treino</option>
        <option value="I" {{ old('natureza',$movimento->natureza)=='I' ? 'selected' : '' }}>Instrução</option>
        <option value="E" {{ old('natureza',$movimento->natureza)=='E' ? 'selected' : '' }}>Especial</option>
    </select>
</div>
<!--Aerodromo Partida-->
<div class="form-group">
    <label for="inputAerodromoPartida">Aeródromo Partida</label>
    <select name="aerodromoPartida" id="inputAerodromoPartida" class="form-control">
        @foreach($aerodromos as $aerodromo)
        <option value="{{$aerodromo->code}}" {{ $aerodromo->code==old('aerodromoPartida', $aerodromo->code) ? 'selected' : '' }}>{{$aerodromo->code." - ".$aerodromo->nome}}</option>
        @endforeach
    </select>
</div>
<!--Aerodromo Chegada-->
<div class="form-group">
    <label for="inputAerodromoChegada">Aeródromo Chegada</label>
    <select name="aerodromoChegada" id="inputAerodromoChegada" class="form-control">
        @foreach($aerodromos as $aerodromo)
            <option value="{{$aerodromo->code}}" {{ $aerodromo->code==old('aerodromoChegada', $aerodromo->code) ? 'selected' : ''}}>{{$aerodromo->code." - ".$aerodromo->nome}}</option>
        @endforeach
    </select>
</div>
<!--Numero de Aterragens-->
<div class="form-group">
    <label for="inputNumAterragens">Número Aterragens</label>
    <input type="number" id="inputNumAterragens" name="numAterragens" value="{{old('numAterragens', $movimento->num_aterragens)}}" class="form-control">
</div>
<!--Numero de Deslocagens-->
<div class="form-group">
    <label for="inputNumDescolagens">Número Descolagens</label>
    <input type="number" id="inputNumDescolagens" name="numDescolagens" value="{{old('numDescolagens', $movimento->num_descolagens)}}" class="form-control">
</div>
<!--Numero de Pessoas-->
<div class="form-group">
    <label for="inputNumPessoas">Número Pessoas a Bordo</label>
    <input type="number" id="inputNumPessoas" name="numPessoas" value="{{old('numPessoas', $movimento->num_pessoas)}}" class="form-control">
</div>
<!--Conta Horas Inicial-->
<div class="form-group">
    <label for="inputContaHorasInicial">Conta Horas Inicial</label>
    <input type="number" id="inputContaHorasInicial" name="numContaHorasInicial" value="{{old('numContaHorasInicial', $movimento->conta_horas_inicio)}}" class="form-control">
</div>
<!--Conta Horas Final-->
<div class="form-group">
    <label for="inputContaHorasFinal">Conta Horas Final</label>
    <input type="number" id="inputContaHorasFinal" name="numContaHorasFinal" onchange="calcularPrecoETempoVoo()" value="{{old('numContaHorasFinal', $movimento->conta_horas_fim)}}" class="form-control">
</div>
<!--Tempo Voo-->
<div class="form-group">
    <label for="inputTempoVoo">Tempo Voo (min)</label>
    <input disabled type="number" id="inputTempoVoo" name="numTempoVoo" value="{{old('numTempoVoo', $movimento->tempo_voo)}}" class="form-control disabled">
</div>
<!--Preço Voo-->
<div class="form-group">
    <label for="inputPrecoVoo">Preço Voo (€)</label>
    <input disabled type="number" id="inputPrecoVoo" name="numPrecoVoo" value="{{old('numPrecoVoo', $movimento->preco_voo)}}" class="form-control disabled">
</div>
<!--Modo Pagamento-->
<div class="form-group">
    <label for="inputModoPagamento">Modo Pagamento</label>
    <select name="modoPagamento" id="inputModoPagamento" class="form-control">
        <option disabled> -- Selecione uma opção -- </option>
        <option value="N" {{ old('modoPagamento', $movimento->modo_pagamento)=='N' ? 'selected' : ''}}>Numerário</option>
        <option value="M" {{ old('modoPagamento', $movimento->modo_pagamento)=='M' ? 'selected' : ''}}>Multibanco</option>
        <option value="T" {{ old('modoPagamento', $movimento->modo_pagamento)=='T' ? 'selected' : ''}}>Transferência</option>
        <option value="P" {{ old('modoPagamento', $movimento->modo_pagamento)=='P' ? 'selected' : ''}}>Pacote de Horas</option>
    </select>
</div>
<!--Recibo-->
<div class="form-group">
    <label for="inputRecibo">Recibo</label>
    <input type="number" id="inputRecibo" name="numRecibo" value="{{old('numRecibo', $movimento->num_recibo)}}" class="form-control disabled">
</div>
<!--Observações-->
<div class="form-group">
    <label for="inputObservacao">Observações</label>
    <textarea id="inputObservacao" name="observacao" value="{{old('observacao', $movimento->observacoes)}}" class="form-control disabled"></textarea>
</div>
<!--Confirmado-->
<!--Tipo Instrucao-->
<div class="form-group">
    <label for="inputtipoInstrucao">Tipo Instrução</label>
    <select name="tipoInstrucao" id="inputtipoInstrucao" class="form-control">
        <option value="" disabled> -- Não é instrução -- </option>
        <option value="D" {{ old('tipoInstrucao', $movimento->tipo_instrucao)=='D' ? 'selected' : ''}}>Duplo Comando</option>
        <option value="S" {{ old('tipoInstrucao', $movimento->tipo_instrucao)=='S' ? 'selected' : ''}}>Solo</option>
    </select>
</div>
<!--Instrutor-->
<div class="form-group">
    <label for="inputInstrutor">Instrutor</label>
    <select name="Instrutors" id="inputInstrutors" class="form-control">
        <option value=""></option>
        @foreach($pilotos as $Instrutor)
            <option value="{{$Instrutor->id}}" {{ $Instrutor->name == Auth::user()->name ? 'selected' : ''}}>{{$Instrutor->name}}</option>
        @endforeach
    </select>
</div>
<!--Num Licença-->
<div class="form-group">
    <label for="inputNumLincenca">Número Licença</label>
    <input type="number" class="form-control" id="inputNumLincenca" name="inputNumLincenca" value="{{old('inputNumLincenca', $movimento->num_licenca_instrutor)}}"/>
</div>
<!--Validade Licença-->
<div class="form-group">
    <label for="inputValidadeLincenca">Validade Licença</label>
    <input type="date" class="form-control" id="inputValidadeLincenca" name="inputValidadeLincenca" value="{{old('inputValidadeLincenca', $movimento->validade_licenca_instrutor)}}"/>
</div>
<!--Tipo Licença-->
<div class="form-group">
    <label for="inputTipoLicenca">Tipo Licença</label>
    <select name="tipoLicenca" id="inputTipoLicenca" class="form-control">
        @foreach($tipoLicencas as $tipoLicenca)
            <option value="{{$tipoLicenca->code}}" {{ old('inputTipoLicenca', $movimento->tipo_licenca_instrutor) ? 'selected' : ''}}>{{$tipoLicenca->nome}}</option>
        @endforeach
    </select>
</div>
<!--Num Certificado-->
<div class="form-group">
    <label for="inputNumCertificado">Número Certificado</label>
    <input type="number" class="form-control" id="inputNumCertificado" name="inputNumCertificado" value="{{old('inputNumCertificado', $movimento->num_Certificado_instrutor)}}"/>
</div>
<!--Validade Certificado-->
<div class="form-group">
    <label for="inputValidadeCertificado">Validade Certificado</label>
    <input type="date" class="form-control" id="inputValidadeCertificado" name="inputValidadeCertificado" value="{{old('inputValidadeCertificado', $movimento->validade_Certificado_instrutor)}}"/>
</div>

<!-- SCRIPT PARA MOSTRAR TEMPO E PREÇO DE VOO -->
<script type="text/javascript">

    function calcularPrecoETempoVoo(){

        //OBTEM E CALCULA AS UNIDADES DE CONTA HORAS DO VOO
        var contaHorasInicial = document.getElementById('inputContaHorasInicial').value;
        var contaHorasFinal = document.getElementById('inputContaHorasFinal').value;
        var valoresContaHoras = contaHorasFinal - contaHorasInicial;


        //OBTEM OS CAMPOS A PREEENCHER
        var inputPreco = document.getElementById('inputPrecoVoo');
        var inputTempoVoo = document.getElementById('inputTempoVoo');


        //OBTEM A MATRICULA DA AERONAVE EM QUESTAO
        var aeronave = document.getElementById('inputAeronaves');
        var matricula = aeronave.options[aeronave.selectedIndex].value;


        //OBTEM A TABELA JSON COM OS PRECOS POR UNIDADE DE CONTA HORAS EM JSON
        fetch("http://ainet.prj.test/aeronaves/"+matricula+"/precos_tempos")
            .then(function(resp){
            return resp.json();
        }).then(function(data){

            //OBTEM O PRECO E MINUTOS POR 1 UNIDADE DE CONTA HORAS
            var preco = data[0].preco;
            var minutosVoo = data[0].minutos;

            //CALCULA E PREENCHE O PRECO DO VOO
            inputPreco.value = Number(valoresContaHoras * preco);

            //CALCULA E PREENCHE O TEMPO DE VOO EM MINUTOS
            inputTempoVoo.value = minutosVoo * valoresContaHoras;

        });


    }
</script>
