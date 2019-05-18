{{csrf_field()}}

<!--Data-->
<div class="form-group">
    <label for="inputData">Data</label>
    <input type="date" id="inputData" name="data" class="form-control">
</div>
<!--Hora Deslocagem-->
<div class="form-group">
    <label for="inputHoraDescolagem">Hora Descolagem</label>
    <input type="time" id="inputHoraDescolagem" name="horaDescolagem" class="form-control">
</div>
<!--Hora Aterragem-->
<div class="form-group">
    <label for="inputHoraAterragem">Hora Aterragem</label>
    <input type="time" id="inputHoraAterragem" name="horaAterragem" class="form-control">
</div>
<!--Aeronave-->
<div class="form-group">
    <label for="inputAeronave">Aeronave</label>
    <select name="aeronaves" id="inputAeronaves" class="form-control">
        @foreach($aeronaves as $aeronave)
    <option value="{{$aeronave->matricula}}">{{$aeronave->matricula}}</option>
            @endforeach
        </select>
    </div>
<!--Numero Diario-->
<div class="form-group">
    <label for="inputNumDiario">Número Diário</label>
    <input type="number" id="inputNumDiario" name="numDiario" class="form-control">
</div>
<!--Numero de Servico-->
<div class="form-group">
    <label for="inputNumServico">Número Serviço</label>
    <input type="number" id="inputNumServico" name="numServico" class="form-control">
</div>
<!--Piloto-->
<div class="form-group">
    <label for="inputAeronave">Aeronave</label>
    <select name="aeronaves" id="inputAeronaves" class="form-control">
        @foreach($pilotos as $piloto)

            @if($piloto->name == Auth::user()->name)
                <option value="{{$piloto->name}}" selected>{{$piloto->name}}</option>
            @else
                <option value="{{$piloto->name}}">{{$piloto->name}}</option>
            @endif
        @endforeach
    </select>
</div>
<!--Natureza-->
<div class="form-group">
    <label for="inputNatureza">Natureza</label>
    <select name="natureza" id="inputNatureza" class="form-control">
        <option disabled selected> -- Selecione uma opção -- </option>
        <option value="T">Treino</option>
        <option value="I">Instrução</option>
        <option value="E">Especial</option>
    </select>
</div>
<!--Aerodromo Partida-->
<div class="form-group">
    <label for="inputAerodromoPartida">Aeródromo Partida</label>
    <select name="aerodromoPartida" id="inputAerodromoPartida" class="form-control">
        @foreach($aerodromos as $aerodromo)
            <option value="{{$aerodromo->code}}">{{$aerodromo->code." - ".$aerodromo->nome}}</option>
        @endforeach
    </select>
</div>
<!--Aerodromo Chegada-->
<div class="form-group">
    <label for="inputAerodromoChegada">Aeródromo Chegada</label>
    <select name="AerodromoChegada" id="inputAerodromoChegada" class="form-control">
        @foreach($aerodromos as $aerodromo)
            <option value="{{$aerodromo->code}}">{{$aerodromo->code." - ".$aerodromo->nome}}</option>
        @endforeach
    </select>
</div>
<!--Numero de Aterragens-->
<div class="form-group">
    <label for="inputNumAterragens">Número Aterragens</label>
    <input type="number" id="inputNumAterragens" name="numAterragens" class="form-control">
</div>
<!--Numero de Deslocagens-->
<div class="form-group">
    <label for="inputNumDescolagens">Número Descolagens</label>
    <input type="number" id="inputNumDescolagens" name="numDescolagens" class="form-control">
</div>
<!--Numero de Pessoas-->
<div class="form-group">
    <label for="inputNumPessoas">Número Pessoas a Bordo</label>
    <input type="number" id="inputNumPessoas" name="numPessoas" class="form-control">
</div>
<!--Conta Horas Inicial-->
<div class="form-group">
    <label for="inputContaHorasInicial">Conta Horas Inicial</label>
    <input type="number" id="inputContaHorasInicial" name="numContaHorasInicial" class="form-control">
</div>
<!--Conta Horas Final-->
<div class="form-group">
    <label for="inputContaHorasFinal">Conta Horas Final</label>
    <input type="number" id="inputContaHorasFinal" name="numContaHorasFinal" class="form-control">
</div>
<!--Tempo Voo-->
<div class="form-group">
    <label for="inputTempoVoo">Tempo Voo</label>
    <input type="number" id="inputTempoVoo" name="numTempoVoo" class="form-control disabled">
</div>
<!--Preço Voo-->
<div class="form-group">
    <label for="inputPrecoVoo">Preço Voo</label>
    <input type="number" id="inputPrecoVoo" name="numPrecoVoo" class="form-control disabled">
</div>
<!--Modo Pagamento-->
<div class="form-group">
    <label for="inputModoPagamento">Modo Pagamento</label>
    <select name="modoPagamento" id="inputModoPagamento" class="form-control">
        <option disabled selected> -- Selecione uma opção -- </option>
        <option value="N">Numerário</option>
        <option value="M">Multibanco</option>
        <option value="T">Transferência</option>
        <option value="P">Pacote de Horas</option>
    </select>
</div>
<!--Recibo-->
<div class="form-group">
    <label for="inputRecibo">Recibo</label>
    <input type="number" id="inputRecibo" name="numRecibo" class="form-control disabled">
</div>
<!--Observações-->
<div class="form-group">
    <label for="inputObservacao">Observações</label>
    <textarea id="inputObservacao" name="observacao" class="form-control disabled"></textarea>
</div>

