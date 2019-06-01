{{csrf_field()}}
<h3>Dados gerais</h3>
<input type="hidden" name="id" value="{{ $movimento->id }}">
<!--Data-->
<div class="form-group">
    <label for="data">Data</label>
    <input type="date" name="data" value="{{old('data', $movimento->data)}}" class="form-control">
</div>
<!--Hora Deslocagem-->
<div class="form-group">
    <label for="hora_descolagem">Hora Descolagem</label>
    <input type="time" name="hora_descolagem" value="{{old('hora_descolagem', date('H:i', strtotime($movimento->hora_descolagem)))}}" class="form-control">
</div>
<!--Hora Aterragem-->
<div class="form-group">
    <label for="hora_aterragem">Hora Aterragem</label>
    <input type="time" name="hora_aterragem" value="{{old('hora_aterragem', date('H:i', strtotime($movimento->hora_aterragem)))}}" class="form-control">
</div>
<!--Aeronave-->
<div class="form-group">
    <label for="aeronave">Aeronave</label>

    <select name="aeronave" id="inputAeronaves" class="form-control">
        @foreach($aeronaves as $aeronave)
            <option value="{{$aeronave->matricula}}" {{old('aeronaves', $movimento->aeronave)==$aeronave->matricula? 'selected' : ''}}>{{$aeronave->matricula}}</option>
            @endforeach
        </select>
    </div>
<!--Numero Diario-->
<div class="form-group">
    <label for="num_diario">Número Diário</label>
    <input type="number" name="num_diario" value="{{old('num_diario', $movimento->num_diario)}}" class="form-control">
</div>
<!--Numero de Servico-->
<div class="form-group">
    <label for="num_servico">Número Serviço</label>
    <input type="number" name="num_servico" value="{{old('num_servico', $movimento->num_servico)}}" class="form-control">
</div>
<br>
<h3>Dados do Piloto</h3>

<!--Piloto-->
<div class="form-group">
    <label for="piloto_id">Piloto</label>
    <select name="piloto_id" class="form-control">
        @foreach($pilotos as $piloto)
            <option value="{{$piloto->id}}" {{ $piloto->name == Auth::user()->name ? 'selected' : ''}}>{{$piloto->name}}</option>
        @endforeach
    </select>
</div>
<!--Num Licença-->
<div class="form-group">
    <label for="num_licenca_piloto">Número Licença</label>
    <input type="number" name="num_licenca_piloto" class="form-control" value="{{old('inputNumLincenca', $movimento->num_licenca_piloto)}}"/>
</div>
<!--Validade Licença-->
<div class="form-group">
    <label for="validade_licenca_piloto">Validade Licença</label>
    <input type="date" name="validade_licenca_piloto" class="form-control" value="{{old('inputValidadeLincenca', $movimento->validade_licenca_piloto)}}"/>
</div>
<!--Tipo Licença-->
<div class="form-group">
    <label for="tipo_licenca_piloto">Tipo Licença</label>
    <select name="tipo_licenca_piloto"class="form-control">
        @foreach($tipoLicencas as $tipoLicenca)
            <option value="{{$tipoLicenca->code}}" {{ old('inputTipoLicenca', $movimento->tipo_licenca_piloto) ? 'selected' : ''}}>{{$tipoLicenca->nome}}</option>
        @endforeach
    </select>
</div>
<!--Num Certificado-->
<div class="form-group">
    <label for="num_certificado_piloto">Número Certificado</label>
    <input type="text" name="num_certificado_piloto" value="{{old('num_certificado_piloto', $movimento->num_certificado_piloto)}}" class="form-control"/>
</div>
<!--Validade Certificado-->
<div class="form-group">
    <label for="validade_certificado_piloto">Validade Certificado</label>
    <input type="date" name="validade_certificado_piloto" class="form-control" value="{{old('validade_certificado_piloto', $movimento->validade_certificado_piloto)}}"/>
</div>
<!--classe_certificado_piloto-->
<div class="form-group">
    <label for="classe_certificado_piloto">Classe Certificado</label>
    <select name="classe_certificado_piloto"class="form-control">
        @foreach($classesCertificados as $classeCertificado)
            <option value="{{$classeCertificado->code}}" {{ old('classe_certificado_piloto', $movimento->classe_certificado_piloto) ? 'selected' : ''}}>{{$classeCertificado->nome}}</option>
        @endforeach
    </select>
</div>
<!--Natureza-->
<div class="form-group">
    <label for="natureza">Natureza</label>
    <select name="natureza"class="form-control">
        <option disabled> -- Selecione uma opção -- </option>
        <option value="T" {{ old('natureza',$movimento->natureza)=='T' ? 'selected' : '' }}>Treino</option>
        <option value="I" {{ old('natureza',$movimento->natureza)=='I' ? 'selected' : '' }}>Instrução</option>
        <option value="E" {{ old('natureza',$movimento->natureza)=='E' ? 'selected' : '' }}>Especial</option>
    </select>
</div>
<br>
<h3>Dados de Voo</h3>

<!--Aerodromo Partida-->
<div class="form-group">
    <label for="aerodromo_partida">Aeródromo Partida</label>
    <select name="aerodromo_partida" class="form-control">
        @foreach($aerodromos as $aerodromo)
        <option value="{{$aerodromo->code}}" {{ $aerodromo->code==old('aerodromoPartida', $aerodromo->code) ? 'selected' : '' }}>{{$aerodromo->code." - ".$aerodromo->nome}}</option>
        @endforeach
    </select>
</div>
<!--Aerodromo Chegada-->
<div class="form-group">
    <label for="aerodromo_chegada">Aeródromo Chegada</label>
    <select name="aerodromo_chegada" class="form-control">
        @foreach($aerodromos as $aerodromo)
            <option value="{{$aerodromo->code}}" {{ $aerodromo->code==old('aerodromoChegada', $aerodromo->code) ? 'selected' : ''}}>{{$aerodromo->code." - ".$aerodromo->nome}}</option>
        @endforeach
    </select>
</div>
<!--Numero de Aterragens-->
<div class="form-group">
    <label for="num_aterragens">Número Aterragens</label>
    <input type="number" name="num_aterragens" value="{{old('numAterragens', $movimento->num_aterragens)}}" class="form-control">
</div>
<!--Numero de Deslocagens-->
<div class="form-group">
    <label for="num_descolagens">Número Descolagens</label>
    <input type="number" name="num_descolagens" value="{{old('num_descolagens', $movimento->num_descolagens)}}" class="form-control">
</div>
<!--Numero de Pessoas-->
<div class="form-group">
    <label for="num_pessoas">Número Pessoas a Bordo</label>
    <input type="number"name="num_pessoas" value="{{old('num_pessoas', $movimento->num_pessoas)}}" class="form-control">
</div>
<!--Conta Horas Inicial-->
<div class="form-group">
    <label for="conta_horas_inicio">Conta Horas Inicial</label>
    <input type="number" id="inputContaHorasInicial" name="conta_horas_inicio" onchange="calcularPrecoETempoVoo()" value="{{old('conta_horas_inicio', $movimento->conta_horas_inicio)}}" class="form-control">
</div>
<!--Conta Horas Final-->
<div class="form-group">
    <label for="conta_horas_fim">Conta Horas Final</label>
    <input type="number" id="inputContaHorasFinal" name="conta_horas_fim" onchange="calcularPrecoETempoVoo()" value="{{old('conta_horas_fim', $movimento->conta_horas_fim)}}" class="form-control">
</div>
<!--Tempo Voo-->
<div class="form-group">
    <label for="tempo_voo">Tempo Voo (min)</label>

    <input disabled type="number" id="inputTempoVoo" name="tempo_voo" value="{{old('tempo_voo', $movimento->tempo_voo)}}" class="form-control disabled">

    <input disabled type="number" name="tempo_voo" id="inputTempoVoo" value="{{old('tempo_voo', $movimento->tempo_voo)}}" class="form-control disabled">

</div>
<!--Preço Voo-->
<div class="form-group">
    <label for="preco_voo">Preço Voo (€)</label>

    <input disabled type="number" id="inputPrecoVoo" name="preco_voo" value="{{old('preco_voo', $movimento->preco_voo)}}" class="form-control disabled">

    <input disabled type="number" name="preco_voo" id="inputPrecoVoo" value="{{old('preco_voo', $movimento->preco_voo)}}" class="form-control disabled">
</div>
<br>
<h3>Dados de Pagamento</h3>

<!--Modo Pagamento-->
<div class="form-group">
    <label for="modo_pagamento">Modo Pagamento</label>
    <select name="modo_pagamento" class="form-control">
        <option value="N" {{ old('modo_pagamento', $movimento->modo_pagamento)=='N' ? 'selected' : ''}}>Numerário</option>
        <option value="M" {{ old('modo_pagamento', $movimento->modo_pagamento)=='M' ? 'selected' : ''}}>Multibanco</option>
        <option value="T" {{ old('modo_pagamento', $movimento->modo_pagamento)=='T' ? 'selected' : ''}}>Transferência</option>
        <option value="P" {{ old('modo_pagamento', $movimento->modo_pagamento)=='P' ? 'selected' : ''}}>Pacote de Horas</option>
    </select>
</div>
<!--Recibo-->
<div class="form-group">
    <label for="modo_pagamento">Recibo</label>
    <input type="number" name="modo_pagamento" value="{{old('modo_pagamento', $movimento->num_recibo)}}" class="form-control disabled">
</div>
<!--Observações-->
<div class="form-group">
    <label for="observacoes">Observações</label>
    <textarea name="observacoes" value="{{old('observacoes', $movimento->observacoes)}}" class="form-control disabled"></textarea>
</div>
<!--Confirmado-->
<input type="hidden" name="confirmado" value="0">
<h3>Dados da Instrução e do Instrutor</h3>

<!--Tipo Instrucao-->
<div class="form-group">
    <label for="tipo_instrucao">Tipo Instrução</label>
    <select name="tipo_instrucao" class="form-control">
        <option value="" disabled> -- Não é instrução -- </option>
        <option value="D" {{ old('tipo_instrucao', $movimento->tipo_instrucao)=='D' ? 'selected' : ''}}>Duplo Comando</option>
        <option value="S" {{ old('tipo_instrucao', $movimento->tipo_instrucao)=='S' ? 'selected' : ''}}>Solo</option>
    </select>
</div>
<!--Instrutor-->
<div class="form-group">
    <label for="instrutor_id">Instrutor</label>
    <select name="instrutor_id" class="form-control">
        <option value="" selected></option>
        @foreach($pilotos as $instrutor)
            <option value="{{$instrutor->id}}">{{$instrutor->name}}</option>
        @endforeach
    </select>
</div>
<!--Num Licença-->
<div class="form-group">
    <label for="num_licenca_instrutor">Número Licença</label>
    <input type="number" name="num_licenca_instrutor" class="form-control" value="{{old('num_licenca_instrutor', $movimento->num_licenca_instrutor)}}"/>
</div>
<!--Validade Licença-->
<div class="form-group">
    <label for="validade_licenca_instrutor">Validade Licença</label>
    <input type="date" name="validade_licenca_instrutor" class="form-control" value="{{old('validade_licenca_instrutor', $movimento->validade_licenca_instrutor)}}"/>
</div>
<!--Tipo Licença-->
<div class="form-group">
    <label for="tipo_licenca_instrutor">Tipo Licença</label>
    <select name="tipo_licenca_instrutor" class="form-control">
        @foreach($tipoLicencas as $tipoLicenca)
            <option value="{{$tipoLicenca->code}}" {{ old('tipo_licenca_instrutor', $movimento->tipo_licenca_instrutor) ? 'selected' : ''}}>{{$tipoLicenca->nome}}</option>
        @endforeach
    </select>
</div>
<!--Num Certificado-->
<div class="form-group">
    <label for="num_certificado_instrutor">Número Certificado</label>
    <input type="text" name="num_certificado_instrutor" class="form-control" value="{{old('num_certificado_instrutor', $movimento->num_certificado_instrutor)}}"/>
</div>
<!--Validade Certificado-->
<div class="form-group">
    <label for="validade_certificado_instrutor">Validade Certificado</label>
    <input type="date" name="validade_certificado_instrutor" value="{{old('validade_certificado_instrutor', $movimento->validade_certificado_instrutor)}}" class="form-control"/>
</div>
<!--classe_certificado_instrutor-->
<div class="form-group">
    <label for="classe_certificado_instrutor">Classe Certificado</label>
    <select name="classe_certificado_instrutor"class="form-control">
        @foreach($classesCertificados as $classeCertificado)
            <option value="{{$classeCertificado->code}}" {{ old('classe_certificado_instrutor', $movimento->classe_certificado_instrutor) ? 'selected' : ''}}>{{$classeCertificado->nome}}</option>
        @endforeach
    </select>
</div>
<br>
<h3>Conflitos</h3>

<!--Tipo Conflito-->
<div class="form-group">
    <label for="tipo_conflito">Tipo Conflito</label>
    <select name="tipo_conflito" class="form-control">
        <option value="" disabled>--</option>
        <option value="S" {{ old('tipo_conflito', $movimento->tipo_conflito)=='S' ? 'selected' : ''}}>Duplo Comando</option>
        <option value="B" {{ old('tipo_conflito', $movimento->tipo_conflito)=='B' ? 'selected' : ''}}>Solo</option>
    </select>
</div>
<!--Justificacao Conflito-->
<div class="form-group">
    <label for="justificacao_conflito">Justificacao Conflito</label>
    <textarea name="justificacao_conflito" value="{{old('justificacao_conflito', $movimento->justificacao_conflito)}}" class="form-control"></textarea>
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
